import{_ as f}from"./AppLayout.b5c1bae9.js";import{j as b,k as i,h as v,o,l as g,d as s,a as x,c as n,m,t,F as h,n as y}from"./app.c0934f99.js";const k=["href"],w=s("span",{class:"hidden sm:inline-block"},"Adicionar",-1),B={class:"grid sm:grid-cols-3 gap-2"},C=["href"],N={class:"flex items-center space-x-3 border-b-2 border-base-200 pb-2 mb-1"},V={class:"avatar"},z={class:"avatar"},A={class:"w-12 rounded-full"},F=["src"],j={class:"font-bold"},D={class:"text-sm font-semibold"},E={class:"text-sm font-semibold"},I={class:"text-sm"},U={__name:"Index",props:{users:Array},setup(p){return(c,L)=>{const u=v("font-awesome-icon");return o(),b(f,null,{header:i(()=>[g(" Usu\xE1rios ")]),actions:i(()=>[s("a",{href:c.route("user.create"),class:"btn btn-primary gap-2"},[x(u,{icon:"fa-solid fa-circle-plus",size:"lg"}),w],8,k)]),default:i(()=>[s("div",B,[(o(!0),n(h,null,m(p.users,e=>{var d,r,l,_;return o(),n("a",{key:e.id,href:c.route("user.show",e.id),class:"card w-full bg-base-100 shadow-xl p-2"},[s("div",N,[s("div",V,[s("div",z,[s("div",A,[s("img",{src:e.profile_photo_url},null,8,F)])])]),s("div",null,[s("div",j,t(e.name),1),s("div",D,t((d=e.username)!=null?d:"---"),1),s("div",E,t((r=e.email)!=null?r:"---"),1),s("div",I,t((_=(l=e.company)==null?void 0:l.name)!=null?_:"---"),1)])]),s("div",null,[(o(!0),n(h,null,m(e.roles,a=>(o(),n("div",{key:a.id,class:y(["badge badge-sm",{"badge-primary":a.name==="super-admin","badge-secondary":a.name==="admin","badge-accent":a.name==="colaborator"}])},t(a.name),3))),128))])],8,C)}),128))])]),_:1})}}};export{U as default};