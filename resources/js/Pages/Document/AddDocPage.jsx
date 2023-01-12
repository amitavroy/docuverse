import React from 'react';
import Layout from "@/Layouts/Layout";
import {Box, Container, Typography} from "@mui/material";
import DocAddForm from "@/Forms/DocAddForm";

const AddDocPage = () => {
  return <Layout>
    <Container fixed>
      <Typography variant='h2'>Add new Document</Typography>
      <Box>
        <DocAddForm />
      </Box>
    </Container>
  </Layout>
}

export  default AddDocPage;
