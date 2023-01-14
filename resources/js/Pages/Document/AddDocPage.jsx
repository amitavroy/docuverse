import React from 'react';
import Layout from "@/Layouts/Layout";
import {Box, Container, Grid, Typography} from "@mui/material";
import DocAddForm from "@/Forms/DocAddForm";

const AddDocPage = () => {
  return <Layout>
    <Container fixed>
      <Grid
        container
        direction="row"
        alignItems="center"
        justifyContent="center"
      >
        <Grid item xs={6}>
          <Typography variant='h2'>Add new Document</Typography>
          <Box>
            <DocAddForm />
          </Box>
        </Grid>
      </Grid>
    </Container>
  </Layout>
}

export  default AddDocPage;
