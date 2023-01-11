import {Inertia} from '@inertiajs/inertia';
import {usePage} from '@inertiajs/inertia-react';
import {React, useEffect} from 'react';
import {useFormik} from 'formik';
import {Box, Button, TextField} from '@mui/material';
import {LoginFormSchema} from './validation.schema';

const LoginForm = () => {
  const handleFormSubmit = (values) => {
    Inertia.post('/login', values);
  };

  const { errors } = usePage().props;

  const formik = useFormik({
    initialValues: { email: '', password: '' },
    onSubmit: handleFormSubmit,
    validationSchema: LoginFormSchema,
  });

  useEffect(() => {
    for (var error in errors) formik.setFieldError(error, errors[error]);
  }, [errors]);

  return (
    <form onSubmit={formik.handleSubmit}>
      <Box sx={{ marginBottom: 2 }}>
        <TextField
          id="email"
          name="email"
          label="Email address"
          variant="standard"
          error={Boolean(formik.touched.email && formik.errors.email)}
          helperText={formik.touched.email && formik.errors.email}
          onBlur={formik.handleBlur}
          onChange={formik.handleChange}
          fullWidth
        />
      </Box>
      <Box>
        <TextField
          id="password"
          name="password"
          label="Enter password"
          type="password"
          variant="standard"
          error={Boolean(formik.touched.password && formik.errors.password)}
          helperText={formik.touched.password && formik.errors.password}
          onBlur={formik.handleBlur}
          onChange={formik.handleChange}
          fullWidth
        />
      </Box>
      <Box sx={{ marginTop: 2 }}>
        <Button
          type="submit"
          variant="contained"
        >
          Login
        </Button>
      </Box>
    </form>
  );
};

export default LoginForm;
