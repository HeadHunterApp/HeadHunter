import axios from "../api/axios";

//terulet
export const postTerulet = (params)=>
    axios.post(`/api/fields/new`, params);

export const putTerulet = (terulet_id, params)=>
    axios.put(`/api/fields/modification/${terulet_id}`, params);

export const deleteTerulet = (terulet_id)=>
    axios.delete(`/api/fields/delete/${terulet_id}`);


//pozicio
export const postPozicio = (params)=>
    axios.post(`/api/positions/new`, params);
    
export const putPozicio = (pozkod, params)=>
    axios.put(`/api/positions/modification/${pozkod}`, params);

export const deletePozicio = (pozkod)=>
    axios.delete(`/api/positions/delete/${pozkod}`);
    

//szakmai ismeret
export const postSzakmaiIsmeret = (params)=>
    axios.post(`/api/skills/new`, params);

export const putSzakmaiIsmeret = (ismeret_id, params)=>
    axios.put(`/api/skills/modification/${ismeret_id}`, params);

export const deleteSzakmaiIsmeret = (ismeret_id)=>
    axios.delete(`/api/skills/delete/${ismeret_id}`);


//nyelvtudas
export const postNyelvtudas = (params)=>
    axios.post(`/api/languages/new`, params);

export const putNyelvtudas = (nyelvkod, params)=>
axios.put(`/api/languages/modification/${nyelvkod}`, params);

export const deleteNyelvtudas = (nyelvkod)=>
axios.delete(`/api/languages/delete/${nyelvkod}`);


//userek
export const getUser = ()=>
    axios.post(`/api/users-all`);

export const deleteUser = (user_id)=>
    axios.delete(`/api/users/delete/${user_id}`);

//fejvadasz
export const getFejvadaszAll = ()=>
    axios.get(`/api/headhunters-all`);
    
export const getFejvadasz = (user_id)=>
    axios.get(`/api/headhunters/${user_id}`);
    
export const postFejvadasz = (params)=>
    axios.post(`/api/headhunters/new`, params);
    
export const putFejvadasz = (user_id, params)=>
    axios.put(`/api/headhunters/modification/${user_id}`, params);
    
export const deleteFejvadasz = (user_id)=>
    axios.delete(`/api/headhunters/delete/${user_id}`);
    
//fejvadasz-terulet
export const getFejvadaszTeruletAll = ()=>
    axios.get(`/api/headhunters/fields`);
    
export const getFejvadaszTerulet = (user_id)=>
    axios.get(`/api/headhunters/${user_id}/fields`);
    
export const postFejvadaszTerulet = (params)=>
    axios.post(`/api/headhunters/fields/new`, params);
    
export const putFejvadaszTerulet = (user_id)=>
    axios.put(`/api/headhunters/${user_id}/fields/modification`, params);
    
export const deleteFejvadaszTerulet = (user_id)=>
    axios.delete(`/api/headhunters/${user_id}/fields/delete`);
    

//allaskereso és kapcsolódó táblái külön contextben
