import React from 'react';
import { Container } from '@mui/material';
import TopNav from '../Components/TopNav';

const Layout = ({ children }) => {
  return (
    <>
      <TopNav />
      <Container fixed>{children}</Container>
    </>
  );
};

export default Layout;
