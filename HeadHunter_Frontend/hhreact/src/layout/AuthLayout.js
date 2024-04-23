import React from "react";
import { Outlet, Navigate } from "react-router-dom";
import useAuthContext from "../contexts/AuthContext";
import Footer from "../components/Footer";
import Header from "../components/Header";

export default function AuthLayout({jogosultFelh}) {
    const { user} = useAuthContext();
    const belepettJogs = user?.jogosultsag;
    const hasJogosultsag = belepettJogs && belepettJogs.includes(jogosultFelh);

  return (
    <>
      <Header />
      {hasJogosultsag ? (
        <Outlet />
      ) : (
        <Navigate to="/unauthorized" replace />
      )}
      <Footer />
    </>
  );
}

