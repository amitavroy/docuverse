import { InertiaLink } from '@inertiajs/inertia-react';
import { DeleteForever, Visibility } from '@mui/icons-material';
import {
  Paper,
  Table,
  TableBody,
  TableCell,
  TableContainer,
  TableHead,
  TableRow,
} from '@mui/material';
import React, { useEffect, useState } from 'react';

function createData(id, title, summary, creator, published_at) {
  return { id, title, summary, creator, published_at };
}

const DocumentTable = ({ data }) => {
  const [rows, setRows] = useState([]);

  useEffect(() => {
    const newRows = [];
    data.forEach((d) => {
      newRows.push(
        createData(d.id, d.title, d.summary, d.creator, d.published_at)
      );
    });
    setRows(newRows);
  }, []);

  return (
    <TableContainer component={Paper}>
      <Table
        sx={{ minWidth: 650 }}
        aria-label="simple table"
      >
        <TableHead>
          <TableRow>
            <TableCell>ID</TableCell>
            <TableCell>Title</TableCell>
            <TableCell>Summary</TableCell>
            <TableCell>Creator</TableCell>
            <TableCell>Actions</TableCell>
          </TableRow>
        </TableHead>
        <TableBody>
          {rows.map((row) => (
            <TableRow key={row.id}>
              <TableCell>{row.id}</TableCell>
              <TableCell>{row.title}</TableCell>
              <TableCell>{row.summary}</TableCell>
              <TableCell>{row.creator.name}</TableCell>
              <TableCell>
                <InertiaLink href={route('doc.view', { id: row.id })}>
                  <Visibility sx={{ marginRight: 1 }} />
                </InertiaLink>
                <DeleteForever />
              </TableCell>
            </TableRow>
          ))}
        </TableBody>
      </Table>
    </TableContainer>
  );
};

export default DocumentTable;
