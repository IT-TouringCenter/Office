export declare module BookformAddRsvnInterface {

    export interface Time {
        id: number;
        meridiem: string;
        travelTimeStart: string;
        travelTimeEnd: string;
        pickupTime: string;
    }

    export interface Price {
        adultSellPrice: number;
        childSellPrice: number;
        adultPrice: number;
        childPrice: number;
        singleRiding: number;
        commissionAdult: number;
        commissionChild: number;
        periodStart: string;
        periodEnd: string;
    }

    export interface TourPrice {
        type: string;
        prices: Price[];
    }

    export interface Pax {
        id: number;
        min: number;
        max: number;
        tourPrices: TourPrice[];
    }

    export interface Privacy {
        id: number;
        privacy: string;
        paxs: Pax[];
    }

    export interface RootObject {
        id: number;
        code: string;
        title: string;
        times: Time[];
        privacies: Privacy[];
    }

}