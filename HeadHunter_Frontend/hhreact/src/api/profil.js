import axios from "../api/axios";

export const getProfilAdmin = (user_id)=>
    axios.get(`/api/admin/user/${user_id}`)

export const getProfilFejvadasz = ()=>
    axios.get(`/api/hunter/headhunters/profile`)

export const putProfilFejvadász = (params) =>
    axios.put('/api/hunter/headhunters/profile/modification', params);

export const postFotoFeltolt = (FormData)=>
    axios.post("route", FormData, { headers:{ "Content-Type": "multipart/form-data"}})

export const getProfilAllaskereso = ()=> 
    axios.get(`/api/seeker/jobseekers/profile`);

export const putProfilAllakereso = (params) =>
    axios.put('/api/seeker/jobseekers/profile/modification', params);

export const getAllaskeresoTapasztalat = ()=>
    axios.get('/api/seeker/jobseekers/profile/exps');

export const putAllaskeresoTapasztalat = (params) =>
    axios.put('/api/seeker/jobseekers/profile/exps/modification', params);

export const getAllaskeresoTanulmany = ()=>
    axios.get('/api/seeker/jobseekers/profile/edu-atts');

export const putAllaskeresoTanulmany = (params)=>
    axios.put('/api/seeker/jobseekers/profile/edu-atts/modification', params);

export const getAllaskeresoNyelvtudas = ()=>
    axios.get('/api/seeker/jobseekers/profile/languages');

export const putAllaskeresoNyelvtudas = (params, config) =>
    axios.put('/api/seeker/jobseekers/profile/languages/modification', params, config);


