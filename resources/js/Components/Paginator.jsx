import React from 'react';
import {Pagination, PaginationItem} from "@mui/material";
import {Inertia} from "@inertiajs/inertia";

const Paginator = ({data}) => {
  const {total, per_page, path, current_page} = data;
  return <Pagination
    showFirstButton
    showLastButton
    count={Math.round(total / per_page)}
    defaultPage={current_page}
    onChange={(change, page) => Inertia.visit(`${path}?page=${page}`)}
  />
}

export default Paginator;
