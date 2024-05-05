import { TrainingPartValue } from "@/Consts/TrainingPart";
export interface User {
    id: number;
    name: string;
    email: string;
    email_verified_at: string;
    created_at: string;
    updated_at: string;
}

export interface TrainingPart {
    id: number;
    user_id?: number;
    name: string;
    created_at: string;
    updated_at: string;
}
export interface Training {
    id: number;
    user_id?: number;
    training_part_id: number;
    name: string;
    training_part: TrainingPart;
    created_at: string;
    updated_at: string;
}

export interface TrainingContent {
    id: number;
    user_id: number;
    training_id: number;
    weight: number;
    reps: number;
    sets: number;
    trainig_date: string;
    created_at: string;
    updated_at: string;
}

export type PageProps<T extends Record<string, unknown> = Record<string, unknown>> = T & {
    auth: {
        user: User;
    };
};
