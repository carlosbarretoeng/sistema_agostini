import{_ as d,A as m}from"./AppLayout.b5c1bae9.js";import{T as _}from"./text.util.6265efc0.js";import{j as h,k as o,h as p,o as a,l as u,b as r,c as n,a as f,e as g,d as e,m as b,t as i,F as v}from"./app.c0934f99.js";const w=["href"],k=e("span",{class:"hidden sm:inline-block"},"Adicionar",-1),x={class:"grid sm:grid-cols-4 gap-2"},y=["href"],V={class:"flex items-center space-x-3"},A={class:"avatar placeholder"},B={class:"bg-neutral-focus text-neutral-content rounded-full w-12"},N={class:"font-bold"},U={__name:"Index",props:{machineries:Array},setup(c){return(t,T)=>{const l=p("font-awesome-icon");return a(),h(d,null,{header:o(()=>[u(" Esta\xE7\xE3o de Trabalho ")]),actions:o(()=>[r(m).canView(t.$page.props.user,{permission:"machinery.create"})?(a(),n("a",{key:0,href:t.route("machinery.create"),class:"btn btn-primary gap-2"},[f(l,{icon:"fa-solid fa-circle-plus",size:"lg"}),k],8,w)):g("",!0)]),default:o(()=>[e("div",x,[(a(!0),n(v,null,b(c.machineries,s=>(a(),n("a",{key:s.id,href:t.route("machinery.show",s.id),class:"card w-full bg-base-100 shadow-xl p-2"},[e("div",V,[e("div",A,[e("div",B,[e("span",null,i(r(_).initials(s.name)),1)])]),e("div",null,[e("div",N,i(s.name),1)])])],8,y))),128))])]),_:1})}}};export{U as default};
