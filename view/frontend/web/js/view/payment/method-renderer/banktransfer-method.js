/**
 * Copyright © 2013-2017 Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
define(
    [
        'ko',
        'Magento_Checkout/js/view/payment/default',
        'jquery'
    ],
    function (ko, Component,$) {
        'use strict';

        return Component.extend({
            defaults: {
                template: 'Ibnab_Additional/payment/banktransfer'
            },
            /*
            initObservable: function () {
                this._super()
                    .observe([
                        'allbank',
                        'activebankowner'
                    ]);
                return this;
            },*/
            getData: function() {
                return {
                    'method': this.item.method,
                    'additional_data': {
                        'bankowner': $('#banktransfer_bankowner').val()
                    }
                };
            },
            /**
             * Get value of instruction field.
             * @returns {String}
             */
            getInstructions: function () {
                return window.checkoutConfig.payment.instructions[this.item.method];
            }

        });
    }
);