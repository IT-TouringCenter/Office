export declare module BookingFormEditInterface {

    export interface BookingInfo {
        tourId: number;
        tourCode: string;
        tourName: string;
        tourPrivacy: string;
        travelTime: string;
        travelDate: string;
        rateTwoPax: number;
        pax: number;
        adultPax: number;
        childPax: number;
        infantPax: number;
        isServiceCharge: boolean;
    }

    export interface HotelInfo {
        name: string;
        room: string;
    }

    export interface GuestInfo {
        name: string;
        isAges: number;
    }

    export interface PaymentInfo {
        tourPrice: string;
        paymentCollect: string;
    }

    export interface BookBy {
        name: string;
        position: string;
        code: number;
        hotel: string;
        tel: string;
        otaCode: string;
    }

    export interface Insurance {
        isInsurance: boolean;
        insuranceReason: string;
    }

    export interface Commission {
        isCommission: boolean;
        amount: number;
    }

    export interface NoteBy {
        name: string;
    }

    export interface Summary {
        adultPrice: number;
        childPrice: number;
        totalAdultPrice: number;
        totalChildPrice: number;
        singleRidingPax: number;
        singleRiding: number;
        serviceCharge: number;
        depositPrice: number;
        discount: string;
        discountPrice: number;
        amount: number;
    }

    export interface InvoiceRef {
        id: number;
        number: string;
    }

    export interface RootObject {
        bookingInfo: BookingInfo;
        hotelInfo: HotelInfo;
        guestInfo: GuestInfo[];
        paymentInfo: PaymentInfo;
        bookBy: BookBy;
        insurance: Insurance;
        commission: Commission;
        noteBy: NoteBy;
        summary: Summary;
        isSpecialRequestOperator: string;
        specialRequest: string;
        specialRequestPrice: number;
        invoiceRef: InvoiceRef;
    }

}

