<template>
<div class="row mb-4">
    <div class="col-3">
    	<div class="card">
    		<div class="card-header">
    				FIlter 
    			</div>
    		<div class="card-body">
    			
    			<div class="form-group mt-3">
    				<label for="">Filter By Category</label>
			       	<select class="form-control" @change="filterByCat()" v-model="category">
			       		<option selected="">Category</option>
			       		<option v-for="category in categories" :value="category.id">{{ category.name }}</option>
			       	</select>
			    </div>
			   <!--  <div class="form-group mt-5">
			       	<select class="form-control">
			       		<option>Location</option>
			       		<option v-for="category in categories" :value="category.id">{{ category.name }}</option>
			       	</select>
			    </div> -->
			    <div class="form-group mt-3">
			    	<label for="">Filter By Make</label>
			       	<select class="form-control" @change="filterByMake()" v-model="make">
			       		<option>Make</option>
			       		<option v-for="make in makes" :value="make.id">{{ make.name }}</option>
			       	</select>
			    </div>
    		</div>
    	</div>
       

    </div>
    <div class="col-9">
        <h3>Cars for sale</h3>
        <!-- <hr> -->
        <div class="card border-0">
            <div class="card-body">
                <div class="row">
                 
                    <div v-if="listings.length" v-for="listing in listings" class="col car-lists border-top border-warning pb-2">
                        <div class="media">
                          <img class="img-thumbnail mr-3" :src="listing.featured_image" :alt="listing.title">
                          <div class="media-body">
                            <h5><a :href="listing.slug">{{ listing.title }}</a></h5>
                            <div class="row">
                                <div class="col">
                                    <strong>Make:</strong> {{ listing.make.name }}<br>
                                    <strong class="">Model:</strong> {{ listing.model.name }}<br>
                                    <span class="fa fa-map-marker"></span><strong>Location:</strong> {{ listing.location }}
                                </div>
                                <div class="col">
                                    <span>Posted: <span class="fa fa-clock"></span> {{ listing.created_at | timeago }}</span><br>
                                    <span>Price: <span class="fa fa-dollar-sign"></span> {{ listing.is_offer ? 'Offer' : listing.price }}</span>
                                </div>
                                <div class="col-2 text-center">
                                    <span class="fa fa-heart"></span><br>
                                    <span>Save</span>
                                </div>
                            </div>
                            
                          </div>
                        </div>
                    </div>
                   <div v-else>
                   		<p>No result found</p>
                   </div>


                </div>
            </div>
        </div>
    </div>
</div>
<!-- <div class="clearfix"></div> -->
</template>
<script>
	var moment = require('moment');
	Vue.filter('moment', function(value, format) {
            return moment.utc(value).local().format(format);
    });
	Vue.filter('timeago', function(value) {
            return moment.utc(value).local().fromNow();
    });
    export default {
        mounted() {
        	this.getListings();
        	this.getCategories();
        	this.getMakes();
            console.log('Component mounted.')
        },
        data() {
	        return {
	        	category:'',
	        	make: '',
	        	model:'',
	        	query:'',
	          	listings: {},
	          	categories: {},
	          	makes: {},
	          	models: {},
	          	message: {
		          	name: '',
		          	seller:'',
		          	customer: '',
		          	message:'',
	          	},
	          	moment: moment
	        }
	    },

	    methods: {
	    	getListings() {
	          window.axios.get('cars-for-sale').then((response) => {
	            this.listings = response.data;
	          });
	        },
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
	        filterByCat(){
	        	this.listings = {};
	        	window.axios.get('/category/'+ this.category).then((response) => {
		            this.listings = response.data;
		        });
	        },
	       	filterByMake(){
	        	this.listings = {};
	        	window.axios.get('/make/'+ this.make).then((response) => {
		            this.listings = response.data;
		        });
	        }
	        // getModels() {
	        // 	this.models = "";
	        //   	window.axios.get('/admin/make/'+ this.listing.make).then((response) => {
		       //      this.models = response.data;
		       //  });
	        // },
	    }

    }
</script>
