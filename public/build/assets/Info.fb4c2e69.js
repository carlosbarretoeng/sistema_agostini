import{u as $,j as E,k as b,h as z,o as s,c as o,l as w,F as p,e as a,d as e,a as r,b as i,q as h}from"./app.c0934f99.js";import{_ as A,A as f}from"./AppLayout.b5c1bae9.js";import{_ as D}from"./InputText.230fb108.js";import{_ as S}from"./InputSelect.4b9144ff.js";const B=["href"],I=e("span",{class:"hidden sm:inline-block"},"Voltar",-1),q=e("span",{class:"hidden sm:inline-block"},"Salvar",-1),F=e("span",{class:"hidden sm:inline-block"},"Atualizar",-1),U=["href"],M=e("span",{class:"hidden sm:inline-block"},"Editar",-1),T={key:1,href:"#deleteModal",class:"btn btn-error gap-2"},j=e("span",{class:"hidden sm:inline-block"},"Excluir",-1),G={class:"modal",id:"deleteModal"},H={class:"modal-box"},J=e("h3",{class:"font-bold text-lg"},"Excluir Empresa",-1),K=e("p",{class:"py-4"},"Tem certeza de que quer excluir essa empresa? Essa opera\xE7\xE3o n\xE3o poder\xE1 ser defeita.",-1),L={class:"modal-action"},O=e("a",{href:"#",class:"btn"},"N\xE3o",-1),P={class:"grid sm:grid-cols-4 gap-2"},Y={__name:"Info",props:{context:String,id:Number,company_id:Number,name:String,companies:Array,departments:Array},setup(_){var y,V,v;const n=_,g=n.context==="create",u=n.context==="show",k=n.context==="edit",d=$({id:(y=n.id)!=null?y:null,name:(V=n.name)!=null?V:null,company_id:(v=n.company_id)!=null?v:null}),x=()=>{h.Inertia.delete(route("department.destroy",n.id))},C=()=>{h.Inertia.post(route("department.store"),d)},N=()=>{h.Inertia.put(route("department.update",n.id),d)};return(l,t)=>{const c=z("font-awesome-icon");return s(),E(A,null,{header:b(()=>[g?(s(),o(p,{key:0},[w(" Novo Departamento ")],64)):a("",!0),u||k?(s(),o(p,{key:1},[w(" Departamento ")],64)):a("",!0)]),actions:b(()=>[e("a",{href:l.route("department.index"),class:"btn btn-outline mr-2 gap-2"},[r(c,{icon:"fa-solid fa-arrow-left",size:"lg"}),I],8,B),g?(s(),o(p,{key:0},[i(f).canView(l.$page.props.user,{permission:"department.create"})?(s(),o("a",{key:0,onClick:t[0]||(t[0]=m=>C()),class:"btn btn-success gap-2"},[r(c,{icon:"fa-solid fa-save",size:"lg"}),q])):a("",!0)],64)):a("",!0),k?(s(),o(p,{key:1},[i(f).canView(l.$page.props.user,{permission:"department.update"})?(s(),o("a",{key:0,onClick:t[1]||(t[1]=m=>N()),class:"btn btn-success gap-2"},[r(c,{icon:"fa-solid fa-arrows-rotate",size:"lg"}),F])):a("",!0)],64)):a("",!0),u?(s(),o(p,{key:2},[i(f).canView(l.$page.props.user,{permission:"department.update"})?(s(),o("a",{key:0,href:l.route("department.edit",_.id),class:"btn btn-info mr-2 gap-2"},[r(c,{icon:"fa-solid fa-edit",size:"lg"}),M],8,U)):a("",!0),i(f).canView(l.$page.props.user,{permission:"department.delete"})?(s(),o("a",T,[r(c,{icon:"fa-solid fa-trash",size:"lg"}),j])):a("",!0),e("div",G,[e("div",H,[J,K,e("div",L,[e("a",{onClick:t[2]||(t[2]=m=>x()),class:"btn"},"Sim"),O])])])],64)):a("",!0)]),default:b(()=>[e("div",P,[r(S,{label:"Empresa",options:_.companies,modelValue:i(d).company_id,"onUpdate:modelValue":t[3]||(t[3]=m=>i(d).company_id=m),disabled:u},null,8,["options","modelValue"]),r(D,{label:"Nome",modelValue:i(d).name,"onUpdate:modelValue":t[4]||(t[4]=m=>i(d).name=m),disabled:u},null,8,["modelValue"])])]),_:1})}}};export{Y as default};
