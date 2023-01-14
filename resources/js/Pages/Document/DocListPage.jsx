import React from 'react';
import Layout from '@/Layouts/Layout';
import {Box, Typography} from '@mui/material';
import Paginator from '@/Components/Paginator';
import DocumentTable from '../../Components/DocumentTable';

const DocumentListPage = ({ documents }) => {
  const { data } = documents;
  return (
    <Layout>
      <Box>
        <Typography variant='h2'>List of documents</Typography>
      </Box>
      <Box>{data && data.length > 0 && <DocumentTable data={data} />}</Box>
      <Box
        sx={{
          marginTop: 4,
          justifyContent: 'center',
          alignItems: 'center',
          display: 'flex',
        }}
      >
        <Paginator data={documents} />
      </Box>
    </Layout>
  );
};

export default DocumentListPage;
