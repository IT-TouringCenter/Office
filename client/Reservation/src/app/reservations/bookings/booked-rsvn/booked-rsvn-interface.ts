export interface BookedRsvnInterface {
    transactionId: number;
    bookingId: string;
    invoiceId: string;
    tourName: string;
    tourFullname: string;
    tourPrivacy: string;
    tourTravel: string;
    tourPax: number;
    hotel: string;
    hotelRoom: string;
    bookBy: string;
    noteBy: string;
    insurance: boolean;
    price: number;
    guestName: string;
}