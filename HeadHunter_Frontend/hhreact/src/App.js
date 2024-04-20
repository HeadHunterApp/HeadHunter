import React from "react";
import { BrowserRouter, Route, Routes } from "react-router-dom";
import "./styles/App.css";
//user vizsgálat:
import useAuthContext from "./contexts/AuthContext";
//layoutok:
import VendegLayout from "./layout/VendegLayout";
import AuthLayout from "./layout/AuthLayout";
//oldalak:
import Fooldal from "./pages/Fooldal";
import Kezdolap from "./pages/Kezdolap";
import Profilok from "./pages/Profilok";
import Allaskereses from "./pages/AllasKereses";
import AllaskerInfo from "./pages/informacio/AllaskerInfo";
import MunkaltatoInfo from "./pages/informacio/MunkaltatoInfo";
import Kapcsolat from "./pages/informacio/Kapcsolat";
import JogosulatlanFelh from "./pages/JogosulatlanFelh";
//a többi page-et még létre kell hozni

export default function App() {
  const { user } = useAuthContext();
  const belepve = !!user;

  return (
    <Routes>
      <Route 
        path="/"
        element={
          belepve ? (
            <AuthLayout />
          ) : (
            <VendegLayout>
              <Route index element={<Fooldal />} />
            </VendegLayout>
          )
        }
      >
        {/*belépés nélkül is elérhető */}
        <Route path="jobs" element={<Allaskereses />} />
        <Route path="seeker-info" element={<AllaskerInfo />} />
        <Route path="employer-info" element={<MunkaltatoInfo />} />
        <Route path="contact" element={<Kapcsolat />} />

        {belepve && (
          <>
            {/*minden belépett felhasználó */}
            <Route index element={<Kezdolap />} />
            <Route path="profile" element={<Profilok />} />

            <Route
              path="seeker"
              element={<AuthLayout jogosultFelh={["álláskereső"]} />}
            >
              {/*elvileg nincs olyan route, amit csak ő érne el */}
            </Route>

            <Route
              path="hunter"
              element={<AuthLayout jogosultFelh={["fejvadász"]} />}
            >
              {/* jövőbeli route-ok:
            
            <Route path="jobseekers" element={<Allaskeresok />} />
            <Route path="queries" element={<Lekerdezesek />} />

            */}
            </Route>

            <Route
              path="admin"
              element={<AuthLayout jogosultFelh={["admin"]} />}
            >
              {/* jövőbeli route-ok:
            
            <Route path="jobseekers" element={<Allaskeresok />} />
            <Route path="headhunters" element={<Fejvadaszok />} />
            <Route path="queries" element={<Lekerdezesek />} />
            <Route path="employers" element={<Munkaltatok />} />
            <Route path="fields" element={<Teruletek />} />
            <Route path="positions" element={<Poziciok />} />
            <Route path="languages" element={<Nyelvtudas />} />
            <Route path="skills" element={<Kepessegek />} />

            */}
            </Route>
          </>
        )}
      </Route>
      <Route path="unauthorized" element={<JogosulatlanFelh />} />

    </Routes>
  );
}
