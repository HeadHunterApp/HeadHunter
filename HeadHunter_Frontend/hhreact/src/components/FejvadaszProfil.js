import React from "react";

const FejvadaszProfil = ({ user, onSubmit }) => {
    const [nev, setNev] = useState(user.nev);
    const [email, setEmail] = useState(user.email);
    const [terulet, setTerulet] = useState(user.terulet);
  
    const handleSubmit = (e) => {
      e.preventDefault();
      // Validáció és adatok küldése a szerverre onSubmit funkcióval
      onSubmit({ nev, email, terulet });
    };
  
    return (
      <form onSubmit={handleSubmit}>
        <div>
          <label htmlFor="nev">Név:</label>
          <input
            type="text"
            id="nev"
            value={name}
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
          <label htmlFor="terulet">Terület:</label>
          <input
            type="text"
            id="terulet"
            value={area}
            onChange={(e) => setTerulet(e.target.value)}
          />
        </div>
        <button type="submit">Mentés</button>
      </form>
    );
  };
  
  export default FejvadaszProfil;