export declare module InvoiceInterface {

    export interface Invoices {
        bookingNo: string;
        refBookingNo: string;
        invoiceNo: string;
    }

    export interface Tours {
        name: string;
        type: string;
        time: string;
        standBy: string;
        date: string;
        privacy: string;
        pax: number;
        adult: number;
        child: number;
        infant: number;
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
        amount: number;
    }

    export interface NoteBy {
        name: string;
        date: string;
        time: string;
    }

    export interface Prices {
        adult: number;
        adultAmount: number;
        child: number;
        childAmount: number;
        singleRiding: number;
        totalPrice: number;
    }

    export interface RootObject {
        invoices: Invoices;
        tours: Tours;
        hotel: Hotel;
        guest: string;
        paymentMode: string;
        paymentCollect: string;
        isServiceCharge: boolean;
        serviceCharge: number;
        specialRequest: string;
        specialRequestPrice: number;
        accountCode: string;
        bookBy: string;
        insurance: Insurance;
        commission: Commission;
        noteBy: NoteBy;
        prices: Prices;
    }

}

