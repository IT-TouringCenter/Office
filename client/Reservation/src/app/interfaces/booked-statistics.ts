export interface BookedStatisticsInterface {
    transactionId: number;
    bookingId: string;
    invoiceId: string;
    tourName: string;
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