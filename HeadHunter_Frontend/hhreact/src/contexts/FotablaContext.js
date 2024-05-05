import axios from "../api/axios";

export const getTerulet = ()=>
    axios.get(`/api/fields-all`);

export const getPozicio = ()=>
    axios.get(`/api/positions-all`);
    
export const getSzakmaiIsmeret = ()=>
    axios.get(`/api/skills-all`);

export const getVegzettseg = ()=>
    axios.get(`/api/edu-attainments-all`);

export const getNyelvtudas = ()=>
    axios.get(`/api/languages-all`);

export const getTapasztalat = ()=>
    axios.get(`/api/experiences-all`);

export const getMunkaltato = ()=>
    axios.get(`/api/employers-all`);

export const postMunkaltato = ()=>
axios.post(`/api/employers/new`);

export const putMunkaltato = (munkaltato_id, params)=>
    axios.put(`/api/employers/modification/${munkaltato_id}`, params);
