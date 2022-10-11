import{u as b,g as j,h as y,o as a,c as d,e as r,d as s,a as n,b as i,F as h,i as L,t as f,m as u,k as Q,j as q}from"./app.775a790a.js";import{_ as G,A as k}from"./AppLayout.f70166d9.js";import{_ as A}from"./InputText.df88593f.js";import{_ as z}from"./InputSelect.58f54399.js";import"./pt-br.b727be27.js";const H=q(" Novo Produto "),J=q(" Produto "),K=["href"],W=s("span",{class:"hidden sm:inline-block"},"Voltar",-1),X=s("span",{class:"hidden sm:inline-block"},"Salvar",-1),Y=s("span",{class:"hidden sm:inline-block"},"Atualizar",-1),Z=["href"],I=s("span",{class:"hidden sm:inline-block"},"Editar",-1),R={key:1,href:"#deleteModal",class:"btn btn-error gap-2"},ss=s("span",{class:"hidden sm:inline-block"},"Excluir",-1),os={class:"modal",id:"deleteModal"},ts={class:"modal-box"},es=s("h3",{class:"font-bold text-lg"},"Excluir Empresa",-1),as=s("p",{class:"py-4"},"Tem certeza de que quer excluir essa empresa? Essa opera\xE7\xE3o n\xE3o poder\xE1 ser defeita.",-1),ds={class:"modal-action"},ns=s("a",{href:"#",class:"btn"},"N\xE3o",-1),is={class:"grid sm:grid-cols-4 gap-2"},ls=s("div",{class:"divider"},"Etapa de Produto",-1),rs={key:0,class:"grid sm:grid-cols-4 gap-2 mb-2"},cs={href:"#addProductModal",class:"btn w-full sm:col-span-4 gap-2"},us=s("span",{class:"hidden sm:inline-block"},"Adicionar Produto",-1),ps={class:"modal",id:"addProductModal"},_s={class:"modal-box"},ms=s("h3",{class:"font-bold text-lg"},"Adicionar Etapa de Produto",-1),hs={class:"modal-action"},bs=s("a",{href:"#",class:"btn"},"Cancelar",-1),fs={class:"grid sm:grid-cols-3 gap-2"},gs={class:"flex items-center space-x-2 h-12 p-2 bg-base-300"},vs={class:"avatar placeholder"},ks={class:"bg-neutral-focus text-neutral-content rounded-full w-6"},ys={class:"font-bold"},xs={class:"flex items-center space-x-2 px-2"},ws={class:"w-full"},Vs={class:"grid grid-cols-2 font-light border-b-2"},Cs=s("div",{class:"font-semibold"},"Esta\xE7\xE3o:",-1),$s={class:"text-right"},Es={class:"grid grid-cols-2 font-light"},Ns=s("div",{class:"font-semibold"},"Tempo M\xE9dio:",-1),Ps={class:"text-right"},As={key:0,class:"bg-base-300/25 grid grid-cols-3 gap-2"},zs=["onClick","disabled"],qs=["onClick"],Ss=["onClick","disabled"],Fs={__name:"Info",props:{context:String,id:Number,company_id:Number|null,name:String,productRecipe:Array,companies:Array,machineries:Array,parts:Array},setup(p){var w,V,C,$;const l=p,x=l.context==="create",g=l.context==="show",v=l.context==="edit",_=b({id:(w=l.id)!=null?w:null,company_id:(V=l.company_id)!=null?V:null,name:(C=l.name)!=null?C:null}),m=b({product_id:($=l.id)!=null?$:null,part_id:null,machinery_id:null,order:l.productRecipe.length+1,quantity:null}),S=()=>{u.Inertia.delete(route("product.destroy",l.id))},U=()=>{u.Inertia.post(route("product.store"),_)},M=()=>{u.Inertia.put(route("product.update",l.id),_)},B=t=>{u.Inertia.delete(route("product_recipe.destroy",t.id),b({product_id:t.productId}))},T=t=>{u.Inertia.put(route("product_recipe.update",t.id),b({id:t.id,product_id:t.productId,order:t.order+1}))},D=t=>{u.Inertia.put(route("product_recipe.update",t.id),b({id:t.id,product_id:t.productId,order:t.order-1}))},F=()=>{m.order=l.productRecipe.length+1,u.Inertia.post(route("product_recipe.store"),m)};return(t,e)=>{const c=Q("font-awesome-icon");return a(),j(G,null,{header:y(()=>[x?(a(),d(h,{key:0},[H],64)):r("",!0),g||v?(a(),d(h,{key:1},[J],64)):r("",!0)]),actions:y(()=>[s("a",{href:t.route("product.index"),class:"btn btn-outline mr-2 gap-2"},[n(c,{icon:"fa-solid fa-arrow-left",size:"lg"}),W],8,K),x?(a(),d(h,{key:0},[i(k).canView(t.$page.props.user,{permission:"product.create"})?(a(),d("a",{key:0,onClick:e[0]||(e[0]=o=>U()),class:"btn btn-success gap-2"},[n(c,{icon:"fa-solid fa-save",size:"lg"}),X])):r("",!0)],64)):r("",!0),v?(a(),d(h,{key:1},[i(k).canView(t.$page.props.user,{permission:"product.update"})?(a(),d("a",{key:0,onClick:e[1]||(e[1]=o=>M()),class:"btn btn-success gap-2"},[n(c,{icon:"fa-solid fa-arrows-rotate",size:"lg"}),Y])):r("",!0)],64)):r("",!0),g?(a(),d(h,{key:2},[i(k).canView(t.$page.props.user,{permission:"product.update"})?(a(),d("a",{key:0,href:t.route("product.edit",p.id),class:"btn btn-info mr-2 gap-2"},[n(c,{icon:"fa-solid fa-edit",size:"lg"}),I],8,Z)):r("",!0),i(k).canView(t.$page.props.user,{permission:"product.delete"})?(a(),d("a",R,[n(c,{icon:"fa-solid fa-trash",size:"lg"}),ss])):r("",!0),s("div",os,[s("div",ts,[es,as,s("div",ds,[s("a",{onClick:e[2]||(e[2]=o=>S()),class:"btn"},"Sim"),ns])])])],64)):r("",!0)]),default:y(()=>[s("div",is,[n(z,{label:"Empresa",options:p.companies,modelValue:i(_).company_id,"onUpdate:modelValue":e[3]||(e[3]=o=>i(_).company_id=o),disabled:g},null,8,["options","modelValue"]),n(A,{label:"Nome",modelValue:i(_).name,"onUpdate:modelValue":e[4]||(e[4]=o=>i(_).name=o),disabled:g},null,8,["modelValue"])]),ls,v?(a(),d("div",rs,[s("a",cs,[n(c,{icon:"fa-solid fa-add",size:"lg"}),us]),s("div",ps,[s("div",_s,[ms,s("div",null,[n(z,{label:"Etapa",options:p.parts,modelValue:i(m).part_id,"onUpdate:modelValue":e[5]||(e[5]=o=>i(m).part_id=o)},null,8,["options","modelValue"]),n(A,{label:"Quantidade",mask:"##",modelValue:i(m).quantity,"onUpdate:modelValue":e[6]||(e[6]=o=>i(m).quantity=o)},null,8,["modelValue"])]),s("div",hs,[bs,s("a",{class:"btn",href:"#",onClick:e[7]||(e[7]=o=>F())},"Adicionar")])])])])):r("",!0),s("div",fs,[(a(!0),d(h,null,L(p.productRecipe,(o,O)=>{var E,N;return a(),d("div",{key:O,class:"card card-compact bg-base-100 shadow-sm"},[s("div",gs,[s("div",vs,[s("div",ks,[s("span",null,f(o.order),1)])]),s("div",null,[s("div",ys,f(o.quantity)+"x "+f(o.partName),1)])]),s("div",xs,[s("div",ws,[s("div",Vs,[Cs,s("div",$s,f((E=o.machineryName)!=null?E:"---"),1)]),s("div",Es,[Ns,s("div",Ps,f((N=o.partAverageProductionTime)!=null?N:"---"),1)])])]),v?(a(),d("div",As,[s("button",{class:"btn btn-ghost btn-sm w-full gap-2",onClick:P=>D(o),disabled:o.order<=1},[n(c,{icon:"fa-solid fa-down-long"})],8,zs),s("button",{class:"btn btn-ghost btn-sm w-full gap-2",onClick:P=>B(o)},[n(c,{icon:"fa-solid fa-trash"})],8,qs),s("button",{class:"btn btn-ghost btn-sm w-full gap-2",onClick:P=>T(o),disabled:o.order===p.productRecipe.length},[n(c,{icon:"fa-solid fa-up-long"})],8,Ss)])):r("",!0)])}),128))])]),_:1})}}};export{Fs as default};
