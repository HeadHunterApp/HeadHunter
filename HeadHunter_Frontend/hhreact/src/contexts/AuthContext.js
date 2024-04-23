import React, { createContext, useContext, useState } from "react";
import axios from "../api/axios";
import { useNavigate } from "react-router-dom";

const AuthContext = createContext();

export const AuthProvider = ({ children }) => {
  const navigate = useNavigate();
  const [user, setUser] = useState(null);
  const [errors, setErrors] = useState({
    name: "",
    email: "",
    password: "",
    password_confirmation: "",
  });

  let token = "";
  const csrf = () =>
    axios.get("/token").then((response) => {
      console.log(response);
      token = response.data;
    });

  const getUser = async () => {
    const { data } = await axios.get("/api/user");
    setUser(data);
  };

  const logout = async () => {
    await csrf();
    console.log(token);
    axios.post("/logout", { _token: token }).then((resp) => {
      setUser(null);
      navigate('/');
      console.log(resp);
    });
  };

  const loginReg = async ({ ...adat }, vegpont) => {
    await csrf();
    console.log(token);
    adat._token = token;
    console.log(adat);

    /*   const config = {
          /*  headers: {
               'X-CSRF-TOKEN': token
           } };*/

    console.log(vegpont);
    try {
      await axios.post(vegpont, adat);
      console.log("siker");
      await getUser();
      navigate("/kezdolap");
    } catch (error) {
      console.log(error);
      if (error.response.status === 422) {
        setErrors(error.response.data.errors);
      }
    }
  };

  return (
    <AuthContext.Provider value={{ logout, loginReg, errors, getUser, user }}>
      {children}
    </AuthContext.Provider>
  );
};
export default function useAuthContext() {
  return useContext(AuthContext);
}
