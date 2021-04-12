<template>
    <div>
        <input ref="numeric" type="text" v-model="amount" :class="css_class" @input="onInput" @focus="onFocus" @blur="onBlur">
        <div class="invalid-feedback" v-show="showVaild"> {{ invalidFeedback }}</div>
    </div>
</template>

<script>
  export default {
    name: 'CMoney',
    props: {
        value: {
            type: [Number, String],
            default: '',
            required: true
        },
        precision: {
            type: Number,
            default: 0
        },
        zero: {
            type: Boolean,
            default: false
        },
        isVaild: {
            type: Boolean,
            default: null
        },
        invalidFeedback : {
            type: String
        }
    },
    data: function () {
        return {
            amount: this.numberFormat(this.value, this.precision)
        }
    },
    watch: {
        valueNumber: function (newValue) {
            if (this.$refs.numeric !== document.activeElement) {
                this.amount = this.numberFormat(newValue, this.precision);
            }
        },
        isVaild: function (newValue){
            return newValue;
        },
    },
    methods: {
        // 金額フォーマット
        numberFormat: function (value, precision) {
            if (this.zero) {
                if (value == '') {
                    value = 0;
                }
            } else {
                if (value == '') {
                    return value;
                }
            }

            var number = parseFloat(value.toString().replace(/[－．０-９]/g, function (s) {
                return String.fromCharCode(s.charCodeAt(0) - 0xFEE0);
            }).replace(/[^-.0-9]/g, '')).toString();

            if (isNaN(number)) {
                number = 0;
            }
            precision = (typeof precision !== 'undefined' ? precision : 0);
            if (!isNaN(precision) && precision >= 0) {
                number = (number / 1).toFixed(precision);
            }

            var result = number.split('.');
            return result[0].replace(/\B(?=(\d{3})+(?!\d))/g, ',') + (result.length == 1 ? '' : '.' + result[1]);
        },
        onInput: function (event) {
            var val = this.numberFormat(this.$refs.numeric.value, this.precision).replace(/,/g, '');
            this.$emit('input', val);
            this.$emit('change', val);
        },
        onFocus: function (event) {
            this.$emit('focus', event);
            this.amount = this.valueNumber;
            setTimeout(function () {
                if (this.$refs.numeric === document.activeElement) {
                    event.target.select();
                }
            }.bind(this), 0);
        },
        onBlur: function (event) {
            this.$emit('blur', event);
            this.amount = this.numberFormat(this.valueNumber, this.precision);
        }
    },
    computed: {
        valueNumber: function () {
            return this.numberFormat(this.value, this.precision).toString().replace(/,/g, '');
        },
        css_class: function () {
            let _css = "form-control text-right";
            if (this.isVaild == null) {

            }else{
                if (this.isVaild) {
                    _css = _css + ' is-valid';
                }else{
                    _css = _css + ' is-invalid';
                }
            }

            if (this.value < 0) {
                _css = _css + ' text-danger';
            }

            return _css;
        },
        showVaild: function (argument) {
            if (this.isVaild == null) {
                return false;
            }else{
                if (this.isVaild) {
                    return false;
                }else{
                    return true;
                }
            }
        },
    }
  }
</script>
