import{r as b,u as h,c as n,a as _,b as o,d as s,t as w,e as d,w as f,f as c,v as u,F as v,o as i,H as x}from"./app.731ac8b3.js";const y={key:0,class:"absolute bottom-0 w-full p-2"},g={class:"alert alert-error shadow-lg"},k=s("svg",{xmlns:"http://www.w3.org/2000/svg",class:"stroke-current flex-shrink-0 h-6 w-6",fill:"none",viewBox:"0 0 24 24"},[s("path",{"stroke-linecap":"round","stroke-linejoin":"round","stroke-width":"2",d:"M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"})],-1),S={class:"min-h-screen flex justify-center items-center bg-primary"},j={class:"card w-80 bg-base-100 shadow-xl"},B=["onSubmit"],V=s("h2",{class:"card-title"},"\xC1rea Restrita",-1),E={class:"mb-4"},F={class:"form-control w-full max-w-xs"},M=s("label",{class:"label"},[s("span",{class:"label-text"},"Usu\xE1rio ou Email")],-1),R={class:"form-control w-full max-w-xs"},U=s("label",{class:"label"},[s("span",{class:"label-text"},"Senha")],-1),N={class:"card-actions justify-end"},T=s("button",{type:"submit",class:"btn btn-primary btn-block"},"Entrar",-1),C=["href"],H={__name:"Login",props:{canResetPassword:Boolean,status:String},setup(m){let a=b(null);const e=h({identify:"carlosbarreto.eng@gmail.com",password:"C@rlos0303"}),p=()=>{e.transform(t=>({...t,remember:e.remember?"on":""})).post(route("login"),{onError:t=>{console.log(Object.values(t).pop()),a.value=Object.values(t).pop(),e.reset(),setTimeout(()=>a.value=null,5e3)},onFinish:t=>{e.reset(["identify","password"])}})};return(t,l)=>(i(),n(v,null,[_(o(x),{title:"Acessar"}),o(a)?(i(),n("div",y,[s("div",g,[s("div",null,[k,s("span",null,w(o(a)),1)])])])):d("",!0),s("div",S,[s("div",j,[s("form",{onSubmit:f(p,["prevent"]),class:"card-body"},[V,s("div",E,[s("div",F,[M,c(s("input",{"onUpdate:modelValue":l[0]||(l[0]=r=>o(e).identify=r),type:"text",placeholder:"Usu\xE1rio ou email",class:"input input-bordered w-full max-w-xs"},null,512),[[u,o(e).identify]])]),s("div",R,[U,c(s("input",{"onUpdate:modelValue":l[1]||(l[1]=r=>o(e).password=r),type:"password",placeholder:"Type here",class:"input input-bordered w-full max-w-xs"},null,512),[[u,o(e).password]])])]),s("div",N,[T,m.canResetPassword?(i(),n("a",{key:0,href:t.route("password.request"),class:"btn btn-xs btn-block btn-secondary btn-ghost"},"Recuperar Senha",8,C)):d("",!0)])],40,B)])])],64))}};export{H as default};