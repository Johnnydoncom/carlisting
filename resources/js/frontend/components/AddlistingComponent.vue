<template>
<form @submit.prevent="formSubmit" method="post">
	<div v-if="success" class="alert alert-success mt-3">
	       Suggestion submitted and will be published after review!
	</div>
    <div class="row">
    	<div class="col-8 border border-2 border-left-0 border-top-0 border-bottom-0">
        	<div class="card">
				<div class="card-body">
		            <div class="form-group">
		                <input type="text" v-model="listing.title" class="form-control" placeholder="Title">
		                <div v-if="errors && errors.title" class="text-danger">{{ errors.title[0] }}</div>
		            </div>
		            <div class="form-group">
		            	<input type="text" placeholder="Location" v-model="listing.location" class="form-control">
		            	<div v-if="errors && errors.location" class="text-danger">{{ errors.location[0] }}</div>
		            </div>
		            <div class="row">
		            	<div class="col">
		            		<div class="form-group">
				            	<input type="text" placeholder="Price" v-model="listing.price" class="form-control">
				            	<div v-if="errors && errors.price" class="text-danger">{{ errors.price[0] }}</div>
				            </div>
		            	</div>
		            	<div class="col">
		            		<div class="form-group">
				            	<input type="text" placeholder="Year" v-model="listing.year" class="form-control">
				            	<div v-if="errors && errors.year" class="text-danger">{{ errors.year[0] }}</div>
				            </div>
		            	</div>
		            	<div class="col">
		            		<div class="form-check form-check-inline">
				            	<label :for="listing.offer" class="form-check-label"><input type="checkbox" v-model="listing.offer" class="form-check-input"> This is an offer</label>
				            </div>
		            	</div>
		            </div>
		            <hr>
		            <div class="form-group">
		                <textarea name="description" class="form-control" v-model="listing.description" rows="10" placeholder="Description"></textarea>
		            </div>
			           <!--  <div class="row">
			           		<div class="col">
			           			<div class="form-group">
			           				<label for="">Transmission</label>
			           				<input type="text" name="tx" class="form-control">
			           			</div>
			           		</div>
			           		<div class="col">
			           			<div class="form-group">
			           				<label for="">VIN</label>
			           				<input type="text" name="" class="form-control">
			           			</div>
			           		</div>
			           		<div class="col">
			           			<div class="form-group">
			           				<label for="">drivetrain</label>
			           				<input type="text" name="" class="form-control">
			           			</div>
			           		</div>
			           	</div> -->
			           <!-- 	<div class="row">
			           		<div class="col">
			           			<div class="form-group">
			           				<label for="">No of Gears</label>
			           				<input type="number" name="" class="form-control">
			           			</div>
			           		</div>
			           		<div class="col">
			           			<div class="form-group">
			           				<label for="">No of Air-Bag</label>
			           				<input type="number" name="" class="form-control">
			           			</div>
			           		</div>
			           		<div class="col">
			           			<div class="form-group">
			           				<label for="">Fuel Type</label>
			           				<input type="text" name="" class="form-control">
			           			</div>
			           		</div>
			           	</div>
			           	<div class="row">
			           		<div class="col">
			           			<div class="form-group">
			           				<label for="">Mileage</label>
			           				<input type="text" name="" class="form-control">
			           			</div>
			           		</div>
			           		<div class="col">
			           			<div class="form-group">
			           				<label for="">Interior Color</label>
			           				<input type="text" name="" class="form-control">
			           			</div>
			           		</div>
			           		<div class="col">
			           			<div class="form-group">
			           				<label for="">Exterior Color</label>
			           				<input type="text" name="" class="form-control">
			           			</div>
			           		</div>
			           	</div> -->
			           	<div class="form-group">
			           		   <button type="submit" class="btn btn-secondary btn-lg"><span v-if="loader" class="loader"></span> Publish</button>
			           	</div>
			    </div>
    		</div>
		</div>

        <div class="col-4">
        	<div class="card">
				<div class="card-body">
            		<div class="form-group border-bottom">
            			<label class="h5">Category</label>
						<select class="custom-select" size="5" v-model="listing.category" name="category">
						  <option selected>Select Category</option>
						  <option v-for="category in categories" :value="category.id">{{ category.name }}</option>
						  
						</select>
            		</div>

            		<div class="form-group mt-4 border-bottom">
            			<label class="h5">Make</label>
						<select class="custom-select" size="5" @change="getModels()" v-model="listing.make">
						  <option v-for="make in makes" :value="make.id">{{ make.name }}</option>
						</select>
            		</div>

            		<div class="form-group mt-4 border-bottom">
            			<label class="h5">Model</label>
						<select class="custom-select" size="5" v-model="listing.model">
							<option selected>Select Model</option>
						  	<option v-for="model in models" :value="model.id">{{ model.name }}</option>
						</select>
            		</div>
            		<div class="form-group mt-4 border-bottom">
            			<label class="h5">Featured Image</label>
						<input type="file" v-on:change="onImageChange" class="form-control">									
            		</div>
            		<div class="col-12" v-if="image">
                          <img :src="image" class="img img-responsive" style="width: 100%">
                     </div>

                </div>
            </div>
        </div>
    </div>
</form>  
</template>
<script>
    export default {
        data() {
	        return {
	        	success: false,
	        	loader: false,
	        	image: '',
	        	make: '',
	        	// formData: {},
	          	categories: {},
	          	makes: {},
	          	models: {},
	          	featured_image:'',
	          	listing: {
		          	title: '',
		          	description:'',
		          	make: '',
		          	model:'',
		          	category:'',
		          	price:'',
		          	featured_image: '',
		          	offer:'',
		          	year:'',
		          	location:''
	          	},
	          	errors: {},
	        }
	    },
	    mounted() {
        	this.getCategories();
        	this.getMakes();
        },
	    methods: {
	        getCategories() {
	          window.axios.get('/category').then((response) => {
	            this.categories = response.data;
	          });
	        },
	        getMakes() {
	          window.axios.get('/make').then((response) => {
	            this.makes = response.data;
	          });
	        },
	        getModels() {
	        	this.models = "";
	          	window.axios.get('/make/'+ this.listing.make+'/models').then((response) => {
		            this.models = response.data;
		        });
	        },

            formSubmit(){
            	// let vm = this;
             //    window.axios.post('/account/listing', vm.listing)
             //    .then(function (response) {
        
             //    	vm.success = true;
             //    	vm.title = vm.listing.description =	vm.listing.make = vm.model = vm.listing.category = vm.listing.price = vm.listing.featured_image = vm.listing.offer = vm.listing.year = vm.listing.location = '';
             //    })
             //    .catch(function (error) {
             //       	console.log(error);
             //    });



                window.axios.post('/account/listing', this.listing).then(response => {
			        // alert('Message sent!');
			        this.success = true;
                	this.listing.title = this.listing.description =	this.listing.make = this.model = this.listing.category = this.listing.price = this.listing.featured_image = this.featured_image = this.listing.offer = this.listing.year = this.listing.location = this.image = '';
			    }).catch(error => {
			        if (error.response.status === 422) {
			          this.errors = error.response.data.errors || {};
			        }
			     });




            },
            // Image upload
            onImageChange(e) {
                let files = e.target.files || e.dataTransfer.files;
                if (!files.length)
                    return;
                this.createImage(files[0]);
            },
            createImage(file) {
                let reader = new FileReader();
                let vm = this;
                reader.onload = (e) => {
                    vm.image = e.target.result;
                    vm.listing.featured_image = e.target.result;
                };
                reader.readAsDataURL(file);
            }

	    }
    }
</script>
