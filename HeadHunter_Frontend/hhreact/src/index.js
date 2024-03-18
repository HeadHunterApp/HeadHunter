import React from 'react';
import ReactDOM from 'react-dom';
import MainPage from './MainPage'; // Change import statement
import './index.css';
import Admin_Allasok from './views/Admin_Allasok';

ReactDOM.render(
  <React.StrictMode>
    <Admin_Allasok /> // Render MainPage component
  </React.StrictMode>,
  document.getElementById('root')
);
