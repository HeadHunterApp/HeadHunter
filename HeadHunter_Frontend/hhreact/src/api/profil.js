import axios from "../api/axios";

export const getProfilAdmin = (user_id)=>
    axios.get(`/admin/user/${user_id}`)

export const getProfilFejvadasz = ()=>
    axios.get(`/hunter/headhunters/profile`)

export const postFotoFeltolt = (FormData)=>
    axios.post("route", FormData, { headers:{ "Content-Type": "multipart/form-data"}})

export const getProfilAllaskereso = ()=>
    axios.get(`/seeker/jobseekers/profile`);



