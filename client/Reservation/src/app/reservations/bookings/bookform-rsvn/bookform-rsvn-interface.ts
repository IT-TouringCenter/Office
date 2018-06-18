export declare module BookformRsvnInterface {
    export interface Invoices {
        bookingNo: string;
        refBookingNo: string;
        invoiceNo: string;
    }

    export interface Tours {
        name: string;
        type: string;
        date: string;
        privacy: string;
        pax: number;
    }

    export interface Hotel {
        name: string;
        room: string;
    }

    export interface Guest {
        name: string;
        ages: string;
    }

    export interface BookBy {
        name: string;
        position: string;
        tel: string;
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

    export interface RootObject {
        invoices: Invoices;
        tours: Tours;
        hotel: Hotel;
        guest: Guest[];
        bookBy: BookBy;
        insurance: Insurance;
        commission: Commission;
        noteBy: NoteBy;
        paymentMode: string;
        paymentCollect: string;
        isServiceCharge: boolean;
        serviceCharge: number;
        specialRequest: string;
        specialRequestPrice: number;
    }

}