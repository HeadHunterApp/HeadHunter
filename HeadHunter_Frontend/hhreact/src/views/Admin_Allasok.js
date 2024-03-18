import React from "react";
import Header from "../components/Header";
import Footer from "../components/Footer";
import "../styles/Fooldal.css";
import "../styles/Admin_allasok.css";
import AllasKartya from '../components/AllasKartya';

const Admin_Allasok = () => {
  return (
    <div>
      <Header />
      <main>
        <AllasKartya/>
        <AllasKartya/>
        <AllasKartya/>
      </main>
      <Footer />
    </div>
  );
};

export default Admin_Allasok;
