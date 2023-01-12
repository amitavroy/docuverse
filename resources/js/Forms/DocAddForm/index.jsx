import {useFormik} from "formik";
import {Box, Button, TextField} from "@mui/material";
import React, {useEffect} from "react";
import {Inertia} from "@inertiajs/inertia";
import {usePage} from "@inertiajs/inertia-react";

const DocAddForm = () => {
  const { errors } = usePage().props;

  const handleSubmit = (values) => {
    Inertia.post(route('doc.store'), values);
  }

  const formik = useFormik({
    initialValues: {title: '', summary: ''},
    onSubmit: handleSubmit
  });

  useEffect(() => {
    for (var error in errors) formik.setFieldError(error, errors[error]);
  }, [errors]);

  return <form onSubmit={formik.handleSubmit}>
    <Box sx={{marginTop: 2}}>
      <TextField
        name='title'
        id='title'
        label='Enter the title of the document'
        variant="standard"
        error={Boolean(formik.touched.title && formik.errors.title)}
        helperText={formik.touched.title && formik.errors.title}
        onBlur={formik.handleBlur}
        onChange={formik.handleChange}
        fullWidth
      />
    </Box>

    <Box sx={{marginTop: 2}}>
      <TextField
        name='summary'
        id='summary'
        label='Enter the summary of the document'
        variant="standard"
        multiline
        rows={2}
        error={Boolean(formik.touched.summary && formik.errors.summary)}
        helperText={formik.touched.summary && formik.errors.summary}
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
        Save
      </Button>
    </Box>
  </form>
}

export default DocAddForm;
