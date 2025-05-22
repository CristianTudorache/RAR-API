<template>
  <div class="container mt-3">

     <!-- Input încărcare imagine -->
    <div class="mb-3 col-md-6">
      <label for="image-upload" class="form-label">Încarcă imagine:</label>
      
      <input
        type="file"
        id="image-upload"
        accept="image/*"
        @change="handleImageUpload"
        class="form-control "
      />
    </div>

    <!-- Preview imagine -->
    <div v-if="imagePreview" class="mb-3 col-md-6">
      <img :src="imagePreview" alt="Preview imagine" style="max-width: 100%; height: auto; border: 1px solid #ccc;" />
    </div>


    <div class="row">
      <div class="col-md-6">

        <!-- Data prestației -->
        <div class="mb-3">
          <label class="input-group-text" for="date-input">Data Prestație:</label>
        <input
          id="date-input"
          class="form-control"
          type="date"
          v-model="selectedDateString"
          :min="minDate"
        />
        </div>

        <!-- Nr. înmatriculare -->
        <div class="input-group mb-3">
          <span class="input-group-text" id="basic-addon1">Nr. înmatriculare</span>
          <input
            ref="inputNrInmatriculare"
            type="text"
             maxlength="7"
            class="form-control"
            placeholder="Introdu nr înmatriculare"
            aria-describedby="basic-addon1"
            v-model="nrInmatriculare"
          />
        </div>

        <small class="text-muted d-block text-center mb-3">Ex: GL12ABC – exact 7 caractere</small>

       <textarea
  class="form-control mb-3"
  id="exampleFormControlTextarea1"
  rows="3"
  maxlength="256"
  placeholder="Observații"
  v-model="observatii"
   @input="autoResize"
></textarea>

         <small v-if="observatii.length < 256" class="text-muted d-block text-center mb-3">
    Mai trebuie să introduci {{ 256 - observatii.length }} caractere.
  </small>

        <!-- VIN -->
        <div class="input-group mb-3">
          <span class="input-group-text" id="labVin">VIN</span>
          <input
            ref="inputVIN"
            type="text"
            class="form-control"
            maxlength="17"
            placeholder="Introdu VIN"
            aria-describedby="labVin"
            v-model="vin"
          />
        </div>

 <small v-if="vin.length < 17" class="text-muted d-block text-center mb-3">
    Mai trebuie să introduci {{ 17 - vin.length }} caractere.
  </small>
<small class="text-muted d-block text-center mb-3">
  Ex: WDB1234561A654321 – exact 17 caractere
</small>
        <!-- Select prestație -->
        <div class="mb-3">
          <select
            v-model="selectedPrestatie"
            @change="adaugaPrestatie"
            class="form-select"
          >
            <option disabled value="">Selectează prestația</option>
            <option
              v-for="opt in optPrestatii"
              :key="opt.id"
              :value="opt.id"
              :class="{ 'text-danger': prestatiiSelectate.some(p => p.id === opt.id) }"
            >
              {{ opt.numePrestatie }}
            </option>
          </select>
        </div>

        <!-- Prestații selectate -->
        <div class="mb-3">
          <h6 class="mb-2">Prestații alese:</h6>
          <div v-for="(item, index) in prestatiiSelectate" :key="item.id" class="mb-2">
            <div class="d-flex justify-content-between align-items-center border rounded p-2 bg-light">
              <div>{{ item.numePrestatie }}</div>
              <button class="btn btn-sm btn-outline-danger" @click="stergePrestatie(index)">
                ✖
              </button>
            </div>
          </div>
        </div>

        <div class="mb-3" v-if="isHidden">
    
          <input
            type="number"
            ref="odomInit"
            class="form-control"
            id="exampleFormControlInput1"
            placeholder="Odometru initial"
            v-model="odometruInit"
          />


          <input
            type="number"
             ref="odomFin"
            class="form-control"
            id="exampleFormControlInput1"
            placeholder="Odometru final"
            v-model="odometruFinal"
          />

          
        </div>


        

        <!-- Buton trimite -->
        <div class="d-grid gap-2">
          <button
            type="button"
            class="btn btn-secondary"
            @click="sendToRar"
          >
            Trimite
          </button>
        </div>

      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';
import Swal from 'sweetalert2';
export default {
  data() {
    return {
     imageFile: null,
      imagePreview: null,
      b64Image: "", // aici vom ține stringul base64
      nrInmatriculare: '',
      selectedDateString: new Date().toISOString().slice(0, 10),
      minDate: new Date().toISOString().slice(0, 10),
      vin: '',
      isValid:false,
      odometruInit: '',
      odometruFinal: 9999999,
      isHidden:false,
      observatii: '',
      selectedPrestatie: '',
      prestatiiSelectate: [],
      optPrestatii: [
        { id: 'OE-1', numePrestatie : 'REPARAȚIE' },
        { id: 'OE-2', numePrestatie : 'ÎNTREȚINERE' },
        { id: 'OE-3', numePrestatie : 'REVIZIE PERIODICĂ' },
        { id: 'OE-4', numePrestatie : 'REGLARE FUNCȚIONALĂ' },
        { id: 'OE-5', numePrestatie : 'MODIFICARE CONSTRUCTIVĂ' },
        { id: 'OE-6', numePrestatie : 'RECONSTRUCȚIE' },
        { id: 'OE-7', numePrestatie : 'ACTUALIZARE SOFTWARE' },
        { id: 'OE-8', numePrestatie : 'ÎNLOCUIRE SEZONIERĂ A ANVELOPELOR' },
        { id: 'OE-D', numePrestatie : 'AVARII GRAVE LA SISTEMUL DE DIRECȚIE' },
        { id: 'OE-F', numePrestatie : 'AVARII GRAVE LA SISTEMUL DE FRÂNARE' },
        { id: 'OE-C', numePrestatie : 'AVARII LA STRUCTURA DE REZISTENȚĂ A CAROSERIEI' },
        { id: 'OE-S', numePrestatie : 'AVARII LA STRUCTURA DE REZISTENȚĂ A ȘASIULUI' },
        { id: 'OE-R', numePrestatie : 'AVARII LA SISTEMUL DE RETINERE ȘI PROTECȚIE' },
        { id: 'OE-A', numePrestatie : 'AVARII LA SISTEM AVANSAT DE ASISTENȚĂ' },
        { id: 'OE-I', numePrestatie : 'ISTORIC ODOMETRU ÎNMATRICULARE STRĂINĂ' },
        { id: 'AITLV', numePrestatie : 'INSPECȚIE TAHOGRAFE / LIMITATOARE DE VITEZĂ' },
        { id: 'R-ODO', numePrestatie : 'REPARAȚIE ODOMETRU' },
        { id: 'I-ODO', numePrestatie : 'ÎNLOCUIRE ODOMETRU' }
      ]
    };
  },

  watch: {
  nrInmatriculare(value) {
    this.nrInmatriculare = value.toUpperCase().trim();
  },
   vin(value) {
    this.vin = value.toUpperCase().trim();
  },

  /*
  odometruFinal(value){
    this.value>=this.odometruInit;
    alert("valoarea trebuie sa fie egala sau mai mare decat cea initiala ");
  }
    */
},
  methods: {

    autoResize(event) {
  const textarea = event.target;
  textarea.style.height = 'auto';
  textarea.style.height = textarea.scrollHeight + 'px';
},

     handleImageUpload(event) {
      const file = event.target.files[0];
      if (file && file.type.startsWith("image/")) {
        this.imageFile = file;
        this.imagePreview = URL.createObjectURL(file);

        // convertim fișierul în base64
        const reader = new FileReader();
        reader.onload = (e) => {
          // e.target.result conține base64-ul cu prefixul data:image/...
          // eliminăm prefixul ca să trimitem doar stringul pur
          const base64String = e.target.result.split(",")[1];
          this.b64Image = base64String;
        };
        reader.readAsDataURL(file);
      } else {
        this.imageFile = null;
        this.imagePreview = null;
        this.b64Image = "";
        alert("Te rog să încarci un fișier imagine valid.");
      }
    },

   adaugaPrestatie() {
  if (this.selectedPrestatie) {
    // verifică dacă nu e deja adăugată
    if (!this.prestatiiSelectate.some(p => p.id === this.selectedPrestatie)) {
      const opt = this.optPrestatii.find(p => p.id === this.selectedPrestatie);

      if (opt) {
        // dacă e una din cele două speciale
        if (opt.id === 'R-ODO' || opt.id === 'I-ODO') {
          // dacă niciuna nu este deja adăugată, permite adăugarea
          const existaCealalta = this.prestatiiSelectate.some(p =>
            ['R-ODO', 'I-ODO'].includes(p.id)
          );

          if (existaCealalta) {
            //alert(");

             Swal.fire({
          icon: 'warning',
          title: 'Atentie!',
          text: 'Doar una dintre prestațiile R-ODO și I-ODO poate fi selectată."!',
        });
            this.selectedPrestatie = '';
            return;
          }

          this.isHidden = true;
        } else {
          // dacă adaugi altceva, verifică dacă mai există R-ODO sau I-ODO
          const areSpeciale = this.prestatiiSelectate.some(p =>
            ['R-ODO', 'I-ODO'].includes(p.id)
          );
          this.isHidden = areSpeciale;
        }

        // adaugă prestația
        this.prestatiiSelectate.push({
          id: opt.id,
          numePrestatie: opt.numePrestatie,
     
        });
      }
    }
    this.selectedPrestatie = ''; // resetează selectul
  }
},
   stergePrestatie(index) {
  const idSters = this.prestatiiSelectate[index].id;
  this.prestatiiSelectate.splice(index, 1);

  if (idSters === 'R-ODO' || idSters === 'I-ODO') {
    this.odometruInit = '';
    this.odometruFinal='9999999';
  }

  const maiExista = this.prestatiiSelectate.some(p =>
    ['R-ODO', 'I-ODO'].includes(p.id)
  );
  this.isHidden = maiExista;

  if (!maiExista) {
    this.odometruInit = '';
  }
}
,
    sendToRar() {
     

      this.isValid=this.valideazaCampuri();

      if (!this.isValid) {
    // dacă campurile nu sunt valide, oprește și nu verifica prestațiile încă
    return false;
  }

     if(this.prestatiiSelectate.length === 0) {
    Swal.fire({
      icon: 'warning',
      title: 'Atenție',
      text: 'Selectați o intervenție din listă!',
    });
    return false;
  }

if(this.odometruFinal<this.odometruInit){
   Swal.fire({
      icon: 'warning',
      title: 'Atenție',
      text: 'Valoare odometru final trebuie sa mie mai mare sau egala cu valoare odometru initial !',
    });

    return false;

}
        //  alert("salveaza");
        //console.log("salveaza");

     //    console.log("prestatie este", JSON.stringify(this.prestatiiSelectate));

    const prestatiiTrimise = this.prestatiiSelectate.map(item => ({
          codPrestatie: item.id,
          numePrestatie:item.numePrestatie,
          idPrezentare: null
        }));

      console.log("prestatie este", prestatiiTrimise);

      let dataToServer;

          dataToServer = {
            'dataPrestatie': this.selectedDateString,
            'nrInmatriculare': this.nrInmatriculare,
            'obs':this.observatii,
            'odometruFinal': this.odometruFinal,
            'odometruInitial': this.odometruInit,
            'prestatii': prestatiiTrimise,
            'sistemReparat':null,
            'status':'FINALIZATA',
            'vin':this.vin,
            'b64Image': this.b64Image || "",
        }

        console.log("obiectul trimis la server" + JSON.stringify(dataToServer));

          axios.post('/api/vehicles/add', dataToServer)
               .then(function(response) {
               
                console.log("apeleaza cart store",response.data);
                
                alert("salvat cu succes");


            })
               .catch(function(response) {
                self.loading = false;
            })

      

     
    },

     valideazaCampuri(){

      var isValid=true;

       if (this.nrInmatriculare === '') {
        Swal.fire({
          icon: 'warning',
          title: 'Atentie!',
          text: 'Introduceti nr inmatriculare !',
        }).then(() => {
          this.$refs.inputNrInmatriculare.focus();
        });
         isValid=false;
         return false;
       
      } 
      
        else if (this.nrInmatriculare.length !== 7) {
  
      
        Swal.fire({
          icon: 'error',
          title: 'Atentie!',
          text: 'Numărul de înmatriculare trebuie să aibă fix 7 caractere.',
        }).then(() => {
          this.$refs.inputNrInmatriculare.focus();
        });

        
         isValid=false;
         return false;
      }

      if (this.vin === '') {
         Swal.fire({
          icon: 'warning',
          title: 'Atentie!',
          text: 'Introduceti nr VIN !',
        }).then(() => {
          this.$refs.inputVIN.focus();
        });
     
         isValid=false;
         return false;

      } else if (this.vin.length !== 17) {
        //alert("Numar VIN invalid! Maxim 17 caractere.");

        Swal.fire({
          icon: 'error',
          title: 'Atentie!',
          text: 'Numărul VIN trebuie să aibă fix 17 caractere.',
        }).then(() => {
          this.$refs.inputVIN.focus();
        });

      
        isValid=false;

        return false;
      } 


      //adaugam conditie si pentru odometru initial si final sa nu fie gol in caz de alegem una din cele 2 opt

      if(this.isHidden==true){


        if(this.odometruInit=='' ){
            Swal.fire({
                  icon: 'warning',
                  title: 'Atentie!',
                  text: 'Introduceti odometru initial  !',
                }).then(() => {
                  this.$refs.odomInit.focus();
              });
                
              isValid=false;
             return false;

         }

         if(this.odometruFinal=='' ){
            Swal.fire({
                  icon: 'warning',
                  title: 'Atentie!',
                  text: 'Introduceti odometru final  !',
                }).then(() => {
                  this.$refs.odomFin.focus();
              });
                
              isValid=false;
             return false;

         }



      }
    

      return isValid;

      

    }
  }
};
</script>

