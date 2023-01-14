import { Button, Typography } from '@mui/material';
import React from 'react';
import Layout from '../Layouts/Layout';
import {InertiaLink} from "@inertiajs/inertia-react";

const Home = () => {
  return (
    <Layout>
      <div>
        <Typography variant="body1">This is sample content</Typography>
        <Button variant="contained">Hello</Button>
        <br/>
        <br/>
        <InertiaLink href={route('doc.add')}>Add document</InertiaLink>
        <InertiaLink href={route('doc.index')}>View document</InertiaLink>
      </div>
    </Layout>
  );
};

export default Home;
