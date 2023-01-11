import { Button, Typography } from '@mui/material';
import React from 'react';
import Layout from '../Layouts/Layout';

const Home = () => {
  return (
    <Layout>
      <div>
        <Typography variant="body1">This is sample content</Typography>
        <Button variant="contained">Hello</Button>
      </div>
    </Layout>
  );
};

export default Home;
