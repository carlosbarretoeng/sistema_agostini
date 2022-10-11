import{T as y}from"./time.util.35ebe2bf.js";import{_ as x,i as V}from"./PrintHeader.def7d186.js";import{_}from"./InputText.df88593f.js";import{c as l,d as t,a as r,x as p,b as m,F as u,i as h,t as n,o as i}from"./app.775a790a.js";import"./pt-br.b727be27.js";const T={class:"bodyToPrint"},U={class:"w-[21cm] bg-white"},w={class:"report-container w-full"},P={class:"report-header"},j={class:"report-header-cell"},F={class:"header-info"},M={class:"report-content"},N={class:"report-content-cell"},A={class:"grid grid-cols-5 gap-2 px-2 mb-2"},B=t("tr",null,[t("td",{class:"px-2 report-content-cell"},[t("div",{class:"grid grid-cols-7 gap-2 bg-base-300 rounded-t-md"},[t("div",{class:"col-span-6 p-2 font-semibold"}," Produto "),t("div",{class:"p-2 text-center font-semibold"}," Quantidade ")])])],-1),E={class:"px-2 report-content-cell"},I={class:"grid grid-cols-7 border-base-300"},Q={class:"col-span-6 p-2"},R={class:"p-2 text-center"},z=t("tr",null,[t("td",{class:"px-2 report-content-cell"},[t("div",{class:"grid grid-cols-5 gap-2 bg-base-300 rounded-b-md mb-2"},"\xA0")])],-1),$=t("tr",null,[t("td",{class:"px-2 report-content-cell"},[t("div",{class:"grid grid-cols-7 gap-2 bg-base-300 rounded-t-md"},[t("div",{class:"col-span-5 p-2 font-semibold"}," Etapa de Trabalho "),t("div",{class:"p-2 font-semibold text-center"}," Quantidade "),t("div",{class:"p-2 font-semibold text-center"}," Realizado ")])])],-1),L={class:"px-2 report-content-cell"},C={class:"grid grid-cols-7 gap-2"},G={class:"col-span-5 p-2"},H={class:"p-2 text-center"},J={class:"p-2 text-center"},K={class:"px-2 report-content-cell"},W={class:"grid grid-cols-7 gap-2 bg-base-300 rounded-b-md"},X=t("div",{class:"col-span-5 p-2 font-semibold"}," Total ",-1),Z={class:"p-2 font-semibold text-center"},tt={class:"p-2 font-semibold text-center"},et={class:"report-container w-full"},st={class:"report-header"},dt={class:"report-header-cell"},ot={class:"header-info hidden print:block"},nt={class:"report-content"},at={class:"report-content-cell px-2"},lt={class:"main"},it={class:""},rt={class:"flex gap-2 bg-base-300 rounded-t-md"},ct={class:"flex-none p-2"},ut={class:"flex grow items-center font-semibold"},_t=t("tr",null,[t("td",{class:"report-content-cell px-2"},[t("div",{class:"main"},[t("div",{class:"grid grid-cols-7 gap-2 bg-base-300"},[t("div",{class:"col-span-5 p-2 font-semibold"}," Etapa de Trabalho "),t("div",{class:"p-2 font-semibold text-center"}," Quantidade "),t("div",{class:"p-2 font-semibold text-center"}," Realizado ")])])])],-1),pt={class:"report-content-cell px-2"},mt={class:"main"},ht={class:"grid grid-cols-7 gap-2"},bt={class:"p-2"},vt={class:"col-span-4 leading-[50px] p-2"},gt={class:"p-2 leading-[50px] text-center"},ft={class:"p-2 leading-[50px] text-center"},Yt={__name:"Print",props:{id:Number,company:Object,progress:Number,status:String,date_start:String,date_finish:String,production_order_products:Array,production_order_parts:Array,production_order_actions:Array},setup(s){const b=s,v=y.toFormatedString(b.date_start,"DD/MM/YYYY"),g=y.toFormatedString(b.date_finish,"DD/MM/YYYY"),k=b.production_order_parts.reduce((a,d)=>{let e=d.product_recipe.part.machinery.department.name,o=d.product_recipe.part.machinery.name,c=d.product_recipe.part.name;return Object.keys(a).indexOf(e)<0&&(a[e]={}),Object.keys(a[e]).indexOf(o)<0&&(a[e][o]={}),Object.keys(a[e][o]).indexOf(c)<0&&(a[e][o][c]={quantity:0,done:0}),a[e][o][c].quantity+=d.quantity,a[e][o][c].done+=d.done,console.log(a),a},{});return(a,d)=>(i(),l("div",T,[t("div",U,[t("table",w,[t("thead",P,[t("tr",null,[t("th",j,[t("div",F,[r(x,{id:s.id,company:s.company,date_start:s.date_start,date_finish:s.date_finish},null,8,["id","company","date_start","date_finish"])])])])]),t("tbody",M,[t("tr",null,[t("td",N,[t("div",A,[t("div",null,[r(_,{label:"Identificador",modelValue:s.id,"onUpdate:modelValue":d[0]||(d[0]=e=>p(id)?id.value=e:null),disabled:""},null,8,["modelValue"])]),t("div",null,[r(_,{label:"Data de In\xEDcio",modelValue:m(v),"onUpdate:modelValue":d[1]||(d[1]=e=>p(v)?v.value=e:null),disabled:""},null,8,["modelValue"])]),t("div",null,[r(_,{label:"Data de In\xEDcio",modelValue:m(g),"onUpdate:modelValue":d[2]||(d[2]=e=>p(g)?g.value=e:null),disabled:""},null,8,["modelValue"])]),t("div",null,[r(_,{label:"Status",modelValue:s.status,"onUpdate:modelValue":d[3]||(d[3]=e=>p(status)?status.value=e:null),disabled:""},null,8,["modelValue"])]),t("div",null,[r(_,{label:"Progresso",modelValue:s.progress,"onUpdate:modelValue":d[4]||(d[4]=e=>p(progress)?progress.value=e:null),disabled:""},null,8,["modelValue"])])])])]),B,(i(!0),l(u,null,h(s.production_order_products,e=>(i(),l("tr",{key:e.id},[t("td",E,[t("div",I,[t("div",Q,n(e.product.name),1),t("div",R,n(e.quantity),1)])])]))),128)),z,$,(i(!0),l(u,null,h(s.production_order_parts,e=>{var o;return i(),l("tr",{key:e.id},[t("td",L,[t("div",C,[t("div",G,n((o=e.product_recipe)==null?void 0:o.part.name),1),t("div",H,n(e.quantity),1),t("div",J,n(e.done),1)])])])}),128)),t("tr",null,[t("td",K,[t("div",W,[X,t("div",Z,n(s.production_order_parts.reduce((e,o)=>e+o.quantity,0)),1),t("div",tt,n(s.production_order_parts.reduce((e,o)=>e+o.done,0)),1)])])])])])]),(i(!0),l(u,null,h(m(k),(e,o,c)=>(i(),l(u,{key:c},[(i(!0),l(u,null,h(e,(D,Y,q)=>(i(),l("div",{key:q,class:"w-[21cm] bg-white mt-2"},[t("table",et,[t("thead",st,[t("tr",null,[t("th",dt,[t("div",ot,[r(x,{id:s.id,company:s.company,date_start:s.date_start,date_finish:s.date_finish},null,8,["id","company","date_start","date_finish"])])])])]),t("tbody",nt,[t("tr",null,[t("td",at,[t("div",lt,[t("div",it,[t("div",rt,[t("div",ct,[r(m(V),{value:"company."+s.company.id+".production_order."+s.id,options:{width:50}},null,8,["value"])]),t("div",ut,n(o)+" - "+n(Y),1)])])])])]),_t,(i(!0),l(u,null,h(D,(f,O,S)=>(i(),l("tr",{key:S},[t("td",pt,[t("div",mt,[t("div",ht,[t("div",bt,[r(m(V),{value:"company."+s.company.id+".production_order."+s.id,options:{width:50}},null,8,["value"])]),t("div",vt,n(O),1),t("div",gt,n(f.quantity),1),t("div",ft,n(f.done),1)])])])]))),128))])])]))),128))],64))),128))]))}};export{Yt as default};