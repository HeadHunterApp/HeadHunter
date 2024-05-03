import React, { useEffect, useState } from "react";
import axios from "../../api/axios";
import {postAllaskerJelentkezes} from "../../contexts/AllasContext";

export default function JelentkezesGomb(props) {

const [config, setConfig] = useState("");
const allas_id = props.allas_id;
  
useEffect(()=>{
  const fetchData = async () => {
  let token = "";

  await axios.get("/api/token").then((response) => {
    console.log(response);
    token = response.data;
  });

  console.log('------------TOKEN--------------')
  console.log(token);

  const config = {
    headers: {
      "X-CSRF-TOKEN": token,
    },
  };
  setConfig(config);    
};

fetchData();
}, []);



const handleSeekerApply = async (e) => {
  e.preventDefault();
  try {
    console.log("config: ");
    console.log(config);
    console.log("allas_id: ");
    console.log(allas_id);
    
    await postAllaskerJelentkezes(allas_id, config);
    alert("Sikeres jelentkezés!");
  } catch (error) {
    console.error(error);
    alert("Hiba történt a jelentkezés során");
  }
};

return (
    <button type="button" onClick={handleSeekerApply}>
              Jelentkezés
    </button>
  );
}