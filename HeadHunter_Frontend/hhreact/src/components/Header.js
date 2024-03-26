import React from 'react';
import Navigation from './Navigation';
import LoginModalForm from './LoginModalForm';
const Header = () => {
  return (
    <header>
        <div className="search-bar">

          <input type="text" placeholder="Keresés..." />
          <LoginModalForm/>        
<<<<<<< Updated upstream
          <LoginModalForm/>
=======
      
>>>>>>> Stashed changes

        </div>
       <Navigation/>
      </header>
  );
};

export default Header;
