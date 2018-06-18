export declare module InvoiceRsvnInterface {

    export interface Invoices {
        bookingNo: string;
        refBookingNo: string;
        invoiceNo: string;
    }

    export interface Tours {
        name: string;
        code: string;
        type: string;
        time: string;
        pickupTime: string;
        standBy: string;
        date: string;
        privacy: string;
        singleRidingPax: number;
        pax: number;
        adult: number;
        child: number;
        infant: number;
        discount: string;
        discountPrice: string;
    }

    export interface Hotel {
        name: string;
        room: string;
    }

    export interface Insurance {
        isInsurance: boolean;
        note: string;
    }

    export interface Commission {
        isCommission: boolean;
        amount: string;
    }

    export interface NoteBy {
        name: string;
        date: string;
        time: string;
    }

    export interface Prices {
        adult: string;
        adultAmount: string;
        child: string;
        childAmount: string;
        singleRidingPerPax: string;
        singleRiding: string;
        specialChargePrice: string;
        depositPrice: string;
        totalPrice: string;
        discountMode: string;
        paymentMode: string;
    }

    export interface RootObject {
        invoices: Invoices;
        tours: Tours;
        hotel: Hotel;
        guest: string;
        paymentMode: string;
        paperColor: string;
        paymentCollect: string;
        isServiceCharge: boolean;
        serviceCharge: string;
        specialRequest: string;
        specialRequestPrice: string;
        isSpecialRequestOperator: number;
        otaCode: string;
        ota: string;
        accountCode: string;
        bookBy: string;
        insurance: Insurance;
        commission: Commission;
        noteBy: NoteBy;
        prices: Prices;
    }

}