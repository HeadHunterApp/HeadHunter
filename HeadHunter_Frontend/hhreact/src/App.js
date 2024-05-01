import React from "react";
import { Route, Routes } from "react-router-dom";
import "./styles/App.css";
//user vizsgálat:
import useAuthContext from "./contexts/AuthContext";
//layoutok:
import VendegLayout from "./layout/VendegLayout";
import AuthLayout from "./layout/AuthLayout";
//oldalak:
import Kezdolap from "./pages/Kezdolap";
import Profilok from "./pages/Profilok";
import Allaskereses from "./pages/AllasKereses";
import AllasAdatlap from "./pages/AllasAdatlap";
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
        element={belepve ? <AuthLayout jogosultFelh={[]} /> : <VendegLayout />}
      >
        {/*kezdőlapon belül kezeljük le a userfüggő tartalomváltozást */}
        <Route index element={<Kezdolap />} />

        {/*belépés nélkül is elérhető */}
        <Route path="jobs" element={<Allaskereses />} />
        <Route path="job-info/:allas_id" element={<AllasAdatlap />} />
        <Route path="seeker-info" element={<AllaskerInfo />} />
        <Route path="employer-info" element={<MunkaltatoInfo />} />
        <Route path="contact" element={<Kapcsolat />} />

        {belepve && (
          <>
            {/*minden belépett felhasználó */}
            <Route path="profile" element={<Profilok />} />

            <Route
              path="seeker"
              element={<AuthLayout jogosultFelh={["álláskereső"]} />}
            >
              {/*jövőbeli route a saját jelentkezései megtekintéséhez:
              
              <Route path="my-applications" element={<JelentkezesSajat />} />

              */}
            </Route>

            <Route
              path="hunter"
              element={<AuthLayout jogosultFelh={["fejvadász"]} />}
            >
              {/* jövőbeli route-ok:
            
            <Route path="jobseekers" element={<Allaskeresok />} />
            <Route path="applicants" element={<Jelentkezok />} />
            <Route path="hired" element={<FelvettJelentkezok />} />

            */}
            </Route>

            <Route
              path="admin"
              element={<AuthLayout jogosultFelh={["admin"]} />}
            >
              {/* jövőbeli route-ok:
            
            <Route path="jobseekers" element={<Allaskeresok />} />
            <Route path="applicants" element={<Jelentkezok />} />
            <Route path="hired" element={<FelvettJelentkezok />} />
            <Route path="headhunters" element={<Fejvadaszok />} />
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
