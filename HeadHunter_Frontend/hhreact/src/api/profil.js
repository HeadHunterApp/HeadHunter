import axios from "../api/axios";

export const getProfilAdmin = (user_id)=>
    axios.get(`/admin/user/${user_id}`)

export const getProfilFejvadasz = ()=>
    axios.get(`/hunter/headhunters/profile`)

export const putProfilFejvadász = () =>
    axios.put('/hunter/headhunters/profile/modification');

export const postFotoFeltolt = (FormData)=>
    axios.post("route", FormData, { headers:{ "Content-Type": "multipart/form-data"}})

export const getProfilAllaskereso = ()=> 
    axios.get(`/seeker/jobseekers/profile`);

export const putProfilAllakereso = () =>
    axios.put('/seeker/jobseekers/profile/modification');

export const getAllaskeresoTapasztalat = ()=>
    axios.get('/seeker/jobseekers/profile/exps');

export const putAllaskeresoTapasztalat = () =>
    axios.put('/seeker/jobseekers/profile/exps/modification');

export const getAllaskeresoTanulmany = ()=>
    axios.get('/seeker/jobseekers/profile/edu-atts');

export const putAllaskeresoTanulmany = ()=>
    axios.put('/seeker/jobseekers/profile/edu-atts/modification');

export const getAllaskeresoNyelvtudas = ()=>
    axios.get('/seeker/jobseekers/profile/languages');

export const putAllaskeresoNyelvtudas = () =>
    axios.put('/seeker/jobseekers/profile/languages/modification');



