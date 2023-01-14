import {AppBar, Box, IconButton, MenuItem, Toolbar, Typography,} from '@mui/material';
import {Container} from '@mui/system';
import React from 'react';
import MenuIcon from '@mui/icons-material/Menu';
import {Inertia} from '@inertiajs/inertia';

const pages = [{ name: 'Documents', link: route('doc.index') }];

const TopNav = () => {
  return (
    <AppBar position="static">
      <Container maxWidth="xl">
        <Toolbar disableGutters>
          <Typography
            variant="h6"
            noWrap
            component={'a'}
            href={route('home')}
            sx={{
              mr: 2,
              display: { xs: 'none', md: 'flex' },
              fontFamily: 'monospace',
              fontWeight: 700,
              letterSpacing: '.3rem',
              color: 'inherit',
              textDecoration: 'none',
            }}
          >
            Docuverse
          </Typography>

          <Box sx={{ flexGrow: 1, display: { xs: 'flex', md: 'none' } }}>
            <IconButton>
              <MenuIcon />
            </IconButton>
          </Box>

          <Box sx={{ flexGrow: 1, display: { xs: 'none', md: 'flex' } }}>
            {pages.map((page) => (
              <MenuItem
                key={page.name}
                onClick={(event) => Inertia.visit(page.link)}
              >
                <Typography textAlign="center">{page.name}</Typography>
              </MenuItem>
            ))}
          </Box>
        </Toolbar>
      </Container>
    </AppBar>
  );
};

export default TopNav;
