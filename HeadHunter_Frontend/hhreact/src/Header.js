import React from 'react';

const Header = () => {
  return (
    <header>
        <div class="search-bar">
          <input type="text" placeholder="Keresés..." />
          <button type="button">Keres</button>
        </div>
        <nav>
          <ul class="">
            <li><a href="#">Álláskereső</a></li>
            <li><a href="#">Álláslehetőségek</a></li>
          </ul>
        </nav>
      </header>
  );
};

export default Header;
