import * as Yup from 'yup';

export const LoginFormSchema = Yup.object().shape({
  email: Yup.string()
    .required('Email is required')
    .email('Should be a valid email'),
  password: Yup.string().required('Password is required'),
});
