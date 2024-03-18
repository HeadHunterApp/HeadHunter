import React from 'react';
import Navigation from './Navigation';

const Header = () => {
  return (
    <header>
        <div class="search-bar">
          <input type="text" placeholder="Keresés..." />
          <button type="button">Keres</button>
        </div>
       <Navigation/>
      </header>
  );
};

export default Header;
