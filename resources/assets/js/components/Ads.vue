<template>
    <div class="ads">
        <a v-for="(ad, i) in ads" :href="paths[i]" class="thumbnail">
            <img :src="paths[i]" :alt="ad.id">
        </a>
    </div>
</template>

<script>
    export default {
        data(){
            return {
                ads: [],
                asset_path: '',
            }
        },

        computed: {
            paths(){
                var arr = []
                this.ads.filter(ad => {
                    arr.push(this.asset_path+'/'+ad.pictures[0].id+'.'+ad.pictures[0].ext)
                })
                return arr
            }
        },

        props: {
            items: {default: 1},
            type: {},
            refresh: { default: 0},
        },

        methods: {
            
            readAds(){
                axios.get('/read-ads-items/'+this.items+'/'+this.type)
                    .then(response => {
                        this.ads = response.data.data
                        this.asset_path = response.data.asset_path
                    })
                    .catch(err => {
                        toastr.error(err.message, 'Error occured!')
                    })
            },
        },

        mounted() {
            console.log('Ads Component mounted.')
            this.readAds()

            if(this.refresh != 0)
                setInterval(()=>{
                    this.readAds()
                }, this.refresh * 1000)
        }
    }
</script>
