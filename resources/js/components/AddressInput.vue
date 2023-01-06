<template>
    <div class="row">
        <div class="col-md-4 mb-3">
            <label for="country">Country</label>
            <x-select
                v-model="address.country"
                :options="countries"
                label="name"
                id="country"
            >
                <template #option="country">
                    <div class="d-flex py-1">
                        <span class="mr-2">{{ country.flag }}</span>
                        <span>{{ country.name }}</span>
                    </div>
                </template>
            </x-select>
            <span v-if="errors && errors[`${$attrs.name}.country`]" class="text-danger">
              {{ errors[`${$attrs.name}.country`] }}
            </span>
        </div>
        <div class="col-md-4 mb-3">
            <label for="state">State</label>
            <x-select
                v-model="address.state"
                :options="states"
                label="name"
                id="state">
                <template #option="state">
                    <div class="py-1">
                        <span>{{ state.name }}</span>
                    </div>
                </template>
            </x-select>
            <span v-if="errors && errors[`${$attrs.name}.state`]" class="text-danger">
              {{ errors[`${$attrs.name}.state`] }}
            </span>
        </div>
        <div class="col-md-4 mb-3">
            <label for="state">City</label>
            <x-select
                v-model="address.city"
                :options="cities"
                label="name"
                id="city">
                <template #option="city">
                    <div class="py-1">
                        <span>{{ city.name }}</span>
                    </div>
                </template>
            </x-select>
            <span v-if="errors && errors[`${$attrs.name}.city`]" class="text-danger">
              {{ errors[`${$attrs.name}.city`] }}
            </span>
        </div>
        <div class="col-md-8">
            <label for="zip">Address</label>
            <app-input
                v-model="address.address"
                type="text"
                placeholder="1234 Main St"
                :name="`${$attrs.name}.address`"
                required />
        </div>
        <div class="col-md-4">
            <label for="zip">Zip Code</label>
            <app-input
                v-model="address.zipcode"
                type="text"
                placeholder="000000"
                :name="`${$attrs.name}.zipcode`"
                required />
        </div>
    </div>
</template>

<script>
import { Country, State, City }  from 'country-state-city';
export default {
    name: "AddressInput",
    components: { },
    props: {
        fill: Object,
    },
    data() {
        return {
            address: {}
        }
    },
    computed: {
        errors() {
            return this.$page.props.errors
        },
        countries() {
            return Country.getAllCountries()
        },
        states() {
            if(!this.address.country) return [];
            return State.getStatesOfCountry(this.address.country.isoCode)
        },
        cities() {
            if(!this.address.state) return [];
            return City.getCitiesOfState(this.address.country.isoCode, this.address.state.isoCode)
        },
        selectedCountry() {
            return this.address.country
        },
        selectedState() {
            return this.address.state
        }
    },

    watch: {
        fill: {
            immediate: true,
            handler(address) {
                if(address) {
                    this.address = address
                }
            }
        },
        address: {
            immediate: true,
            handler(address) {
                this.$emit("input", address);
            }
        },
        // selectedCountry: {
        //     immediate: false,
        //     handler(country) {
        //         if(country) {
        //             this.address.state = null;
        //             this.address.city = null;
        //         }
        //     }
        // },
        // selectedState: {
        //     immediate: true,
        //     handler(state) {
        //         if(state) {
        //             this.address.city = null;
        //         }
        //     }
        // }
    }
}
</script>
