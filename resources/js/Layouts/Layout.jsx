import React from 'react';
import { Container } from '@mui/material';

const Layout = ({ children }) => {
  return <Container fixed>{children}</Container>;
};

export default Layout;
