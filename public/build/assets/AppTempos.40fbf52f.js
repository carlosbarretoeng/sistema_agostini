import{j as g,k as y,o as t,d as s,c as o,e as r,m as u,t as h,b as v,_ as k,F as i}from"./app.c0934f99.js";import{_ as x}from"./AppLayout.b5c1bae9.js";const w={class:""},I={key:0},A=s("div",{class:"text-center text-2xl font-bold"},"Sem ordens de produ\xE7\xE3o",-1),B=[A],F={class:"card-body p-4 grid grid-cols-4"},N=["value"],V={class:"text-xl font-bold col-span-4 text-center"},z={key:0,class:"col-span-4"},C=["href"],O=s("span",null,"Iniciar",-1),P=[O],R={class:"col-span-4"},S=s("div",{class:"text-center font-medium"},"Voc\xEA esta executando:",-1),j={key:0},D={key:0,class:"col-span-4"},E=["href"],L=s("span",null,"Iniciar",-1),M=[L],T={key:1,class:"col-span-4"},$=["href"],q=s("span",null,"Retomar",-1),G=[q],H={class:"col-span-2"},J=["href"],K=s("span",null,"Interromper",-1),Q=[K],U={class:"col-span-2"},W=["href"],X=s("span",null,"Finalizar",-1),Y=[X],es={__name:"AppTempos",props:{production_orders:Array,ordens_aguardando:Array,ordens_producao:Array},setup(a){const c=a,l=n=>c.ordens_producao.length===0,p=n=>!l()&&c.ordens_producao.filter(d=>d.type==="Produ\xE7\xE3o").length===0,f=n=>!l()&&c.ordens_producao.filter(d=>d.type==="Produ\xE7\xE3o").length>0;return(n,d)=>(t(),g(x,{title:"In\xEDcio"},{default:y(()=>[s("div",w,[a.production_orders.length===0?(t(),o("div",I,B)):r("",!0),(t(!0),o(i,null,u(a.production_orders,(e,m)=>(t(),o("div",{key:m,class:"w-full bg-base-100 shadow-xl mb-4"},[s("div",F,[s("progress",{class:"progress w-full col-span-4",value:e.progress,max:"100"},null,8,N),s("div",V,"Ordem Monitorada #"+h(e.id),1),v(k).indexOf(a.ordens_aguardando,e.id)>-1?(t(),o("div",z,[s("a",{class:"btn btn-primary gap-2 w-full",href:n.route("production_order.start",e.id)},P,8,C)])):(t(),o(i,{key:1},[s("div",R,[S,(t(!0),o(i,null,u(a.ordens_producao,(_,b)=>(t(),o("div",{key:b,class:"text-xs text-center mb-1"},[e.id===_.id?(t(),o("span",j,h(_.texto),1)):r("",!0)]))),128))]),l(e.id)?(t(),o("div",D,[s("a",{class:"btn btn-primary gap-2 w-full",href:n.route("production_order.start",e.id)},M,8,E)])):r("",!0),p(e.id)?(t(),o("div",T,[s("a",{class:"btn btn-success gap-2 w-full",href:n.route("production_order.start",e.id)},G,8,$)])):r("",!0),f(e.id)?(t(),o(i,{key:2},[s("div",H,[s("a",{class:"btn btn-secondary gap-2 w-full",href:n.route("production_order.stop",e.id)},Q,8,J)]),s("div",U,[s("a",{class:"btn btn-negative gap-2 w-full",href:n.route("production_order.finalize",e.id)},Y,8,W)])],64)):r("",!0)],64))])]))),128))])]),_:1}))}};export{es as default};