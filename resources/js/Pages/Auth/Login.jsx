import { Grid, Typography } from '@mui/material';
import { Container } from '@mui/system';
import React from 'react';
import LoginForm from '../../Forms/LoginForm';

const LoginPage = () => {
  return (
    <Container fixed>
      <Grid
        container
        direction="row"
        alignItems="center"
        justifyContent="center"
        style={{ minHeight: '100vh' }}
      >
        <Grid
          item
          xs={4}
        >
          <Typography variant="h2">Login</Typography>
          <LoginForm />
        </Grid>
      </Grid>
    </Container>
  );
};

export default LoginPage;
