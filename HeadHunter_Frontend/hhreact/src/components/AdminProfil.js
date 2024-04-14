/* import { useState } from "react";
import { getProfilAdmin, postFotoFeltolt } from "../api/profil";

//ez egyébként nem is kell

    const AdminProfil = ({ user, onSubmit }) => {
        const [nev, setNev] = useState(user.nev);
        const [email, setEmail] = useState(user.email);
        const [password, setPassword] = useState("");
        const [jogosultsag, setJogosultság] = useState(user.password);

        const handleSubmit = (e) => {
            e.preventDefault();
            getProfilAdmin(user.user_id)
            .then(response => {
                // Folytatni a mentési folyamatot a válasz alapján
                onSubmit({ nev, email, password, jogosultsag });
            })
            .catch(error => {
                console.error("Hiba történt a profil lekérésekor:", error);
            });
          };

        const fenykepFeltoltes = (event) =>{
            event.preventDefault();
            const fajl = event.target.files[0];
            let FormData = new FormData();
            FormData.append(fajl.name, fajl)
            postFotoFeltolt(FormData)//megfelelő routot meg kell adni(írni)!!!
                .then(response => {
                    console.log("Fénykép sikeresen feltöltve:", response);
                })
                .catch(error => {
                    console.error("Hiba történt a fénykép feltöltésekor:", error);
                });
        }

    return(
        <form onSubmit={handleSubmit}>
        <div>
          <label htmlFor="nev">Név:</label>
          <input
            type="text"
            id="nev"
            value={nev}
            onChange={(e) => setNev(e.target.value)}
          />
        </div>
        <div>
          <label htmlFor="email">E-mail:</label>
          <input
            type="email"
            id="email"
            value={email}
            onChange={(e) => setEmail(e.target.value)}
          />
          </div>
        <div>
          <label htmlFor="pwd">Jelszó:</label>
          <input
            type="password"
            id="pwd"
            value={password}
            onChange={(e) => setPassword(e.target.value)}
          />
        </div>
        <div>
          <label htmlFor="fenykep">Fénykép:</label>
          <input
            type="file"
            id="fenykep"
            onChange={fenykepFeltoltes}
          />
        </div>
        <div>
          <label htmlFor="jogosultsag">Terület:</label>
          <input
            type="text"
            id="jogosultsag"
            value={jogosultsag}
            onChange={(e) => setJogosultság(e.target.value)}
          />
        </div>
        <button type="submit">Mentés</button>
      </form>
    )
}

export default AdminProfil; */