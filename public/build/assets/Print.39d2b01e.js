import{_ as I,c as d,d as t,a as k,F as m,m as f,t as a,b as q,o as i,e as N}from"./app.c0934f99.js";import{T as P}from"./time.util.04a5000e.js";import{_ as Y,i as D}from"./PrintHeader.0c62bdcb.js";import"./pt-br.a403408c.js";const w={class:"bodyToPrint"},F={class:"w-[21cm] bg-white"},M={class:"report-container w-full"},A={class:"report-header"},B={class:"report-header-cell"},C={class:"header-info"},V={class:"report-content"},j=t("tr",null,[t("td",{class:"px-2 report-content-cell"},[t("div",{class:"grid grid-cols-7 gap-2 bg-base-300 rounded-t-md"},[t("div",{class:"col-span-6 p-2 font-semibold"}," Produto "),t("div",{class:"p-2 text-center font-semibold"}," Quantidade ")])])],-1),z={class:"px-2 report-content-cell"},R={class:"grid grid-cols-7 border-base-300"},$={class:"col-span-6 p-2 text-sm"},L={class:"p-2 text-center text-sm"},O=t("tr",null,[t("td",{class:"px-2 report-content-cell"},[t("div",{class:"grid grid-cols-5 gap-2 bg-base-300 rounded-b-md mb-2"},"\xA0")])],-1),U=t("tr",null,[t("td",{class:"px-2 report-content-cell"},[t("div",{class:"grid grid-cols-7 gap-2 bg-base-300 rounded-t-md"},[t("div",{class:"col-span-3 p-2 font-semibold"}," Etapa de Trabalho "),t("div",{class:"col-span-2 p-2 font-semibold text-center"}," Produto "),t("div",{class:"p-2 font-semibold text-center"}," Quantidade "),t("div",{class:"p-2 font-semibold text-center"}," Realizado ")])])],-1),G={class:"px-2 report-content-cell"},H={class:"grid grid-cols-7 gap-2"},J={class:"col-span-3 p-2 text-sm"},K={class:"col-span-2 p-2 text-sm text-center"},W={class:"p-2 text-center"},X={class:"p-2 text-center"},Z={class:"px-2 report-content-cell"},tt={class:"grid grid-cols-7 gap-2 bg-base-300 rounded-b-md"},et=t("div",{class:"col-span-5 p-2 font-semibold"}," Total ",-1),st={class:"p-2 font-semibold text-center"},nt={class:"p-2 font-semibold text-center"},ot={key:0,class:"w-[21cm] bg-white mt-2"},dt={class:"report-container w-full"},at={class:"report-header"},it={class:"report-header-cell"},rt={class:"header-info hidden print:block"},ct={class:"report-content"},lt={class:"report-content-cell px-2"},pt={class:"main"},_t={class:""},mt={class:"flex gap-2 bg-base-300 rounded-md"},ht={class:"flex-none p-2"},ut={class:"flex flex-col grow justify-center items-left font-semibold"},ft={class:"py-4 border-b-4 border-base-200"},bt=t("div",{class:"grid grid-cols-7 gap-2 bg-base-300"},[t("div",{class:"col-span-5 p-2 font-semibold"}," Etapa de Trabalho "),t("div",{class:"p-2 font-semibold text-center"}," Quantidade "),t("div",{class:"p-2 font-semibold text-center"}," Realizado ")],-1),yt={key:0,class:"report-content-cell"},gt={class:"main"},vt={class:"grid grid-cols-7 gap-2"},xt={class:"col-span-5 p-2"},It={class:"p-2 text-center"},kt={class:"p-2 text-center"},Et={__name:"Print",props:{id:Number,company:Object,progress:Number,status:String,date_start:String,date_finish:String,production_order_products:Array,production_order_parts:Array,production_order_actions:Array},setup(o){const v=o;P.toFormatedString(v.date_start,"DD/MM/YYYY"),P.toFormatedString(v.date_finish,"DD/MM/YYYY");const E=v.production_order_parts.reduce((n,s)=>{let e=s.product_recipe.part.machinery.department.name,l=s.product_recipe.part.machinery.name,p=s.product_recipe.part.name,b=s.product_recipe.product.company_id,c=s.product_recipe.part.machinery.department.id,_=s.product_recipe.part.machinery.id,y=s.product_recipe.part.id,h=0,g=0,x=0;return n.filter(r=>r.departmentId===c).length||n.push({departmentId:c,departmentName:e,machineries:[]}),n.forEach(r=>{r.departmentId===c&&(r.machineries.filter(u=>u.machineryId===_).length||r.machineries.push({machineryId:_,machineryName:l,machineryQrcode:"company."+b+".department."+c+".machinery."+_,parts:[]}),r.machineries.forEach(u=>{u.machineryId===_&&(u.parts.filter(T=>T.partId===y).length||u.parts.push({partId:y,partName:p,partQrcode:"company."+b+".department."+c+".machinery."+_+".part."+y,quantity:0,done:0}))}))}),h=I.findIndex(n,r=>r.departmentId===c),g=I.findIndex(n[h].machineries,r=>r.machineryId===_),x=I.findIndex(n[h].machineries[g].parts,r=>r.partId===y),n[h].machineries[g].parts[x].quantity+=s.quantity,n[h].machineries[g].parts[x].done+=s.done,n},[]),Q=()=>{let n=window.print();console.log(n)},S=n=>n.parts.filter(s=>s.quantity!=s.done).length>0;return(n,s)=>(i(),d("div",w,[t("button",{onClick:s[0]||(s[0]=e=>Q()),class:"btn btn-block print:hidden"},"Clique aqui para imprimir"),t("div",F,[t("table",M,[t("thead",A,[t("tr",null,[t("th",B,[t("div",C,[k(Y,{id:o.id,company:o.company,date_start:o.date_start,date_finish:o.date_finish},null,8,["id","company","date_start","date_finish"])])])])]),t("tbody",V,[j,(i(!0),d(m,null,f(o.production_order_products,e=>(i(),d("tr",{key:e.id},[t("td",z,[t("div",R,[t("div",$,a(e.product.name),1),t("div",L,a(e.quantity),1)])])]))),128)),O,U,(i(!0),d(m,null,f(o.production_order_parts,e=>{var l,p;return i(),d("tr",{key:e.id},[t("td",G,[t("div",H,[t("div",J,a((l=e.product_recipe)==null?void 0:l.part.name),1),t("div",K,a((p=e.product_recipe)==null?void 0:p.product.name),1),t("div",W,a(e.quantity),1),t("div",X,a(e.done),1)])])])}),128)),t("tr",null,[t("td",Z,[t("div",tt,[et,t("div",st,a(o.production_order_parts.reduce((e,l)=>e+l.quantity,0)),1),t("div",nt,a(o.production_order_parts.reduce((e,l)=>e+l.done,0)),1)])])])])])]),(i(!0),d(m,null,f(q(E),(e,l)=>(i(),d(m,{key:l},[(i(!0),d(m,null,f(e.machineries,(p,b)=>(i(),d(m,{key:b},[S(p)?(i(),d("div",ot,[t("table",dt,[t("thead",at,[t("tr",null,[t("th",it,[t("div",rt,[k(Y,{id:o.id,company:o.company,date_start:o.date_start,date_finish:o.date_finish},null,8,["id","company","date_start","date_finish"])])])])]),t("tbody",ct,[t("tr",null,[t("td",lt,[t("div",pt,[t("div",_t,[t("div",mt,[t("div",ht,[k(q(D),{value:p.machineryQrcode,options:{width:100}},null,8,["value"])]),t("div",ut,[t("div",ft,a(e.departmentName)+" - "+a(p.machineryName),1),bt,(i(!0),d(m,null,f(p.parts,(c,_)=>(i(),d("div",{key:_,class:"font-normal"},[c.quantity?(i(),d("div",yt,[t("div",gt,[t("div",vt,[t("div",xt,a(c.partName),1),t("div",It,a(c.quantity),1),t("div",kt,a(c.done),1)])])])):N("",!0)]))),128))])])])])])])])])])):N("",!0)],64))),128))],64))),128))]))}};export{Et as default};