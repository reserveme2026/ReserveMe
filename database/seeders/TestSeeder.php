<?php

namespace Database\Seeders;

use App\Models\Appointment;
use App\Models\BlockedTime;
use App\Models\Business;
use App\Models\Employee;
use App\Models\Schedule;
use App\Models\Service;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class TestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $password = Hash::make('demo1234');

        // Owners
        $ridaOwner = User::updateOrCreate(
            ['email' => 'rida.owner@reservme.com'],
            [
                'name' => 'Rida Owner',
                'password' => $password,
                'role' => 'owner',
                'owner_plan' => 'premium',
            ]
        );

        $lauraOwner = User::updateOrCreate(
            ['email' => 'laura.owner@reservme.com'],
            [
                'name' => 'Laura Owner',
                'password' => $password,
                'role' => 'owner',
                'owner_plan' => 'pro',
            ]
        );

        // Clients
        $carmen = User::updateOrCreate(
            ['email' => 'carmen.cliente@reservme.com'],
            [
                'name' => 'Carmen Ruiz',
                'password' => $password,
                'role' => 'client',
                'owner_plan' => null,
            ]
        );

        $david = User::updateOrCreate(
            ['email' => 'david.cliente@reservme.com'],
            [
                'name' => 'David Martin',
                'password' => $password,
                'role' => 'client',
                'owner_plan' => null,
            ]
        );

        $lucia = User::updateOrCreate(
            ['email' => 'lucia.cliente@reservme.com'],
            [
                'name' => 'Lucia Gomez',
                'password' => $password,
                'role' => 'client',
                'owner_plan' => null,
            ]
        );

        $sergio = User::updateOrCreate(
            ['email' => 'sergio.cliente@reservme.com'],
            [
                'name' => 'Sergio Perez',
                'password' => $password,
                'role' => 'client',
                'owner_plan' => null,
            ]
        );

        $elena = User::updateOrCreate(
            ['email' => 'elena.cliente@reservme.com'],
            [
                'name' => 'Elena Torres',
                'password' => $password,
                'role' => 'client',
                'owner_plan' => null,
            ]
        );

        // Employee users
        User::updateOrCreate(
            ['email' => 'juan@reservme.com'],
            [
                'name' => 'Juan',
                'password' => $password,
                'role' => 'employee',
                'owner_plan' => null,
            ]
        );

        User::updateOrCreate(
            ['email' => 'jose@reservme.com'],
            [
                'name' => 'Jose',
                'password' => $password,
                'role' => 'employee',
                'owner_plan' => null,
            ]
        );

        User::updateOrCreate(
            ['email' => 'maria@reservme.com'],
            [
                'name' => 'Maria',
                'password' => $password,
                'role' => 'employee',
                'owner_plan' => null,
            ]
        );

        User::updateOrCreate(
            ['email' => 'ana@reservme.com'],
            [
                'name' => 'Ana',
                'password' => $password,
                'role' => 'employee',
                'owner_plan' => null,
            ]
        );

        User::updateOrCreate(
            ['email' => 'paula@reservme.com'],
            [
                'name' => 'Paula',
                'password' => $password,
                'role' => 'employee',
                'owner_plan' => null,
            ]
        );

        User::updateOrCreate(
            ['email' => 'claudia@reservme.com'],
            [
                'name' => 'Claudia',
                'password' => $password,
                'role' => 'employee',
                'owner_plan' => null,
            ]
        );

        User::updateOrCreate(
            ['email' => 'miguel@reservme.com'],
            [
                'name' => 'Miguel',
                'password' => $password,
                'role' => 'employee',
                'owner_plan' => null,
            ]
        );

        // Businesses
        $ridaBarbershop = Business::updateOrCreate(
            ['email' => 'hola@ridabarbershop.es'],
            [
                'name' => 'Rida Barbershop',
                'description' => 'Barberia moderna con cortes, degradados y arreglo de barba.',
                'phone' => '611223344',
                'address' => 'Calle Fuencarral 18, Madrid',
                'image' => null,
                'owner_id' => $ridaOwner->id,
            ]
        );

        $tiendaUnas = Business::updateOrCreate(
            ['email' => 'citas@tiendaunasmadrid.es'],
            [
                'name' => 'Tienda Unas Madrid',
                'description' => 'Centro de manicura y pedicura con servicios rapidos y semipermanentes.',
                'phone' => '622334455',
                'address' => 'Gran Via 42, Madrid',
                'image' => null,
                'owner_id' => $lauraOwner->id,
            ]
        );

        $glowBeauty = Business::updateOrCreate(
            ['email' => 'hola@glowbeautystudio.es'],
            [
                'name' => 'Glow Beauty Studio',
                'description' => 'Centro de estetica facial y cuidado personal.',
                'phone' => '633445566',
                'address' => 'Calle Alcala 121, Madrid',
                'image' => null,
                'owner_id' => $ridaOwner->id,
            ]
        );

        // Employees
        $juan = Employee::updateOrCreate(
            ['email' => 'juan@reservme.com'],
            [
                'name' => 'Juan',
                'phone' => '612000111',
                'business_id' => $ridaBarbershop->id,
            ]
        );

        $jose = Employee::updateOrCreate(
            ['email' => 'jose@reservme.com'],
            [
                'name' => 'Jose',
                'phone' => '612000112',
                'business_id' => $ridaBarbershop->id,
            ]
        );

        $miguel = Employee::updateOrCreate(
            ['email' => 'miguel@reservme.com'],
            [
                'name' => 'Miguel',
                'phone' => '612000113',
                'business_id' => $ridaBarbershop->id,
            ]
        );

        $maria = Employee::updateOrCreate(
            ['email' => 'maria@reservme.com'],
            [
                'name' => 'Maria',
                'phone' => '623000111',
                'business_id' => $tiendaUnas->id,
            ]
        );

        $ana = Employee::updateOrCreate(
            ['email' => 'ana@reservme.com'],
            [
                'name' => 'Ana',
                'phone' => '623000112',
                'business_id' => $tiendaUnas->id,
            ]
        );

        $paula = Employee::updateOrCreate(
            ['email' => 'paula@reservme.com'],
            [
                'name' => 'Paula',
                'phone' => '634000111',
                'business_id' => $glowBeauty->id,
            ]
        );

        $claudia = Employee::updateOrCreate(
            ['email' => 'claudia@reservme.com'],
            [
                'name' => 'Claudia',
                'phone' => '634000112',
                'business_id' => $glowBeauty->id,
            ]
        );

        // Services
        $corteClasico = Service::updateOrCreate(
            ['business_id' => $ridaBarbershop->id, 'name' => 'Corte clasico'],
            [
                'description' => 'Corte clasico a tijera o maquina.',
                'duration_minutes' => 30,
                'price' => 12.00,
            ]
        );

        $corteBarba = Service::updateOrCreate(
            ['business_id' => $ridaBarbershop->id, 'name' => 'Corte + barba'],
            [
                'description' => 'Corte completo con arreglo de barba.',
                'duration_minutes' => 45,
                'price' => 20.00,
            ]
        );

        $arregloBarba = Service::updateOrCreate(
            ['business_id' => $ridaBarbershop->id, 'name' => 'Arreglo de barba'],
            [
                'description' => 'Perfilado y arreglo rapido de barba.',
                'duration_minutes' => 20,
                'price' => 9.00,
            ]
        );

        $manicura = Service::updateOrCreate(
            ['business_id' => $tiendaUnas->id, 'name' => 'Manicura semipermanente'],
            [
                'description' => 'Manicura completa con esmaltado semipermanente.',
                'duration_minutes' => 60,
                'price' => 24.00,
            ]
        );

        $pedicura = Service::updateOrCreate(
            ['business_id' => $tiendaUnas->id, 'name' => 'Pedicura spa'],
            [
                'description' => 'Pedicura con exfoliacion e hidratacion.',
                'duration_minutes' => 50,
                'price' => 28.00,
            ]
        );

        $manicuraExpress = Service::updateOrCreate(
            ['business_id' => $tiendaUnas->id, 'name' => 'Manicura express'],
            [
                'description' => 'Servicio rapido de limpieza y esmaltado.',
                'duration_minutes' => 30,
                'price' => 14.00,
            ]
        );

        $limpiezaFacial = Service::updateOrCreate(
            ['business_id' => $glowBeauty->id, 'name' => 'Limpieza facial'],
            [
                'description' => 'Tratamiento facial completo.',
                'duration_minutes' => 50,
                'price' => 35.00,
            ]
        );

        $cejas = Service::updateOrCreate(
            ['business_id' => $glowBeauty->id, 'name' => 'Diseno de cejas'],
            [
                'description' => 'Diseno y definicion de cejas.',
                'duration_minutes' => 20,
                'price' => 12.00,
            ]
        );

        $depilacion = Service::updateOrCreate(
            ['business_id' => $glowBeauty->id, 'name' => 'Depilacion facial'],
            [
                'description' => 'Depilacion de zonas faciales.',
                'duration_minutes' => 25,
                'price' => 15.00,
            ]
        );

        // Schedules
        foreach ([1, 2, 3, 4, 5] as $day) {
            Schedule::firstOrCreate(['employee_id' => $juan->id, 'day_of_week' => $day, 'start_time' => '10:00:00', 'end_time' => '14:00:00']);
            Schedule::firstOrCreate(['employee_id' => $juan->id, 'day_of_week' => $day, 'start_time' => '16:00:00', 'end_time' => '20:00:00']);

            Schedule::firstOrCreate(['employee_id' => $jose->id, 'day_of_week' => $day, 'start_time' => '10:30:00', 'end_time' => '14:30:00']);
            Schedule::firstOrCreate(['employee_id' => $jose->id, 'day_of_week' => $day, 'start_time' => '16:30:00', 'end_time' => '20:30:00']);

            Schedule::firstOrCreate(['employee_id' => $miguel->id, 'day_of_week' => $day, 'start_time' => '09:30:00', 'end_time' => '13:30:00']);
            Schedule::firstOrCreate(['employee_id' => $miguel->id, 'day_of_week' => $day, 'start_time' => '15:30:00', 'end_time' => '19:30:00']);

            Schedule::firstOrCreate(['employee_id' => $maria->id, 'day_of_week' => $day, 'start_time' => '09:30:00', 'end_time' => '14:00:00']);
            Schedule::firstOrCreate(['employee_id' => $maria->id, 'day_of_week' => $day, 'start_time' => '15:30:00', 'end_time' => '19:30:00']);

            Schedule::firstOrCreate(['employee_id' => $ana->id, 'day_of_week' => $day, 'start_time' => '10:00:00', 'end_time' => '14:00:00']);
            Schedule::firstOrCreate(['employee_id' => $ana->id, 'day_of_week' => $day, 'start_time' => '16:00:00', 'end_time' => '20:00:00']);

            Schedule::firstOrCreate(['employee_id' => $paula->id, 'day_of_week' => $day, 'start_time' => '10:00:00', 'end_time' => '14:00:00']);
            Schedule::firstOrCreate(['employee_id' => $paula->id, 'day_of_week' => $day, 'start_time' => '16:00:00', 'end_time' => '19:30:00']);

            Schedule::firstOrCreate(['employee_id' => $claudia->id, 'day_of_week' => $day, 'start_time' => '11:00:00', 'end_time' => '14:00:00']);
            Schedule::firstOrCreate(['employee_id' => $claudia->id, 'day_of_week' => $day, 'start_time' => '16:30:00', 'end_time' => '20:00:00']);
        }

        foreach ([6] as $day) {
            Schedule::firstOrCreate(['employee_id' => $juan->id, 'day_of_week' => $day, 'start_time' => '10:00:00', 'end_time' => '14:00:00']);
            Schedule::firstOrCreate(['employee_id' => $jose->id, 'day_of_week' => $day, 'start_time' => '10:00:00', 'end_time' => '14:00:00']);
            Schedule::firstOrCreate(['employee_id' => $maria->id, 'day_of_week' => $day, 'start_time' => '10:00:00', 'end_time' => '14:00:00']);
            Schedule::firstOrCreate(['employee_id' => $ana->id, 'day_of_week' => $day, 'start_time' => '10:00:00', 'end_time' => '14:00:00']);
        }

        // Future dates
        $nextTuesday = Carbon::now()->next(Carbon::TUESDAY);
        $nextWednesday = Carbon::now()->next(Carbon::WEDNESDAY);
        $nextThursday = Carbon::now()->next(Carbon::THURSDAY);
        $nextFriday = Carbon::now()->next(Carbon::FRIDAY);
        $nextSaturday = Carbon::now()->next(Carbon::SATURDAY);

        // Blocked times
        BlockedTime::updateOrCreate(
            [
                'employee_id' => $jose->id,
                'block_date' => $nextTuesday->toDateString(),
                'start_time' => '12:00:00',
                'end_time' => '13:30:00',
            ],
            ['reason' => 'Cita medica']
        );

        BlockedTime::updateOrCreate(
            [
                'employee_id' => $maria->id,
                'block_date' => $nextWednesday->toDateString(),
                'start_time' => '16:00:00',
                'end_time' => '18:00:00',
            ],
            ['reason' => 'Curso de formacion']
        );

        BlockedTime::updateOrCreate(
            [
                'employee_id' => $ana->id,
                'block_date' => $nextThursday->toDateString(),
                'start_time' => '10:00:00',
                'end_time' => '12:00:00',
            ],
            ['reason' => 'Gestion interna']
        );

        BlockedTime::updateOrCreate(
            [
                'employee_id' => $paula->id,
                'block_date' => $nextFriday->toDateString(),
                'start_time' => '17:00:00',
                'end_time' => '19:00:00',
            ],
            ['reason' => 'Ausencia personal']
        );

        // Appointments
        Appointment::updateOrCreate(
            [
                'business_id' => $ridaBarbershop->id,
                'employee_id' => $juan->id,
                'appointment_date' => $nextTuesday->toDateString(),
                'start_time' => '10:00:00',
            ],
            [
                'user_id' => $carmen->id,
                'service_id' => $corteClasico->id,
                'end_time' => Carbon::parse('10:00:00')->addMinutes($corteClasico->duration_minutes)->format('H:i:s'),
                'status' => 'confirmed',
                'service_name' => $corteClasico->name,
                'service_duration_minutes' => $corteClasico->duration_minutes,
                'service_price' => $corteClasico->price,
                'notes' => 'Cliente habitual',
            ]
        );

        Appointment::updateOrCreate(
            [
                'business_id' => $ridaBarbershop->id,
                'employee_id' => $jose->id,
                'appointment_date' => $nextTuesday->toDateString(),
                'start_time' => '11:00:00',
            ],
            [
                'user_id' => $david->id,
                'service_id' => $corteBarba->id,
                'end_time' => Carbon::parse('11:00:00')->addMinutes($corteBarba->duration_minutes)->format('H:i:s'),
                'status' => 'pending',
                'service_name' => $corteBarba->name,
                'service_duration_minutes' => $corteBarba->duration_minutes,
                'service_price' => $corteBarba->price,
                'notes' => 'Primera visita',
            ]
        );

        Appointment::updateOrCreate(
            [
                'business_id' => $ridaBarbershop->id,
                'employee_id' => $miguel->id,
                'appointment_date' => $nextWednesday->toDateString(),
                'start_time' => '17:00:00',
            ],
            [
                'user_id' => $lucia->id,
                'service_id' => $arregloBarba->id,
                'end_time' => Carbon::parse('17:00:00')->addMinutes($arregloBarba->duration_minutes)->format('H:i:s'),
                'status' => 'cancelled',
                'service_name' => $arregloBarba->name,
                'service_duration_minutes' => $arregloBarba->duration_minutes,
                'service_price' => $arregloBarba->price,
                'notes' => 'Reagendar la semana que viene',
            ]
        );

        Appointment::updateOrCreate(
            [
                'business_id' => $tiendaUnas->id,
                'employee_id' => $maria->id,
                'appointment_date' => $nextThursday->toDateString(),
                'start_time' => '12:00:00',
            ],
            [
                'user_id' => $carmen->id,
                'service_id' => $manicura->id,
                'end_time' => Carbon::parse('12:00:00')->addMinutes($manicura->duration_minutes)->format('H:i:s'),
                'status' => 'confirmed',
                'service_name' => $manicura->name,
                'service_duration_minutes' => $manicura->duration_minutes,
                'service_price' => $manicura->price,
                'notes' => 'Color nude',
            ]
        );

        Appointment::updateOrCreate(
            [
                'business_id' => $tiendaUnas->id,
                'employee_id' => $ana->id,
                'appointment_date' => $nextFriday->toDateString(),
                'start_time' => '16:00:00',
            ],
            [
                'user_id' => $sergio->id,
                'service_id' => $pedicura->id,
                'end_time' => Carbon::parse('16:00:00')->addMinutes($pedicura->duration_minutes)->format('H:i:s'),
                'status' => 'pending',
                'service_name' => $pedicura->name,
                'service_duration_minutes' => $pedicura->duration_minutes,
                'service_price' => $pedicura->price,
                'notes' => 'Con decoracion sencilla',
            ]
        );

        Appointment::updateOrCreate(
            [
                'business_id' => $tiendaUnas->id,
                'employee_id' => $maria->id,
                'appointment_date' => $nextSaturday->toDateString(),
                'start_time' => '10:30:00',
            ],
            [
                'user_id' => $david->id,
                'service_id' => $manicuraExpress->id,
                'end_time' => Carbon::parse('10:30:00')->addMinutes($manicuraExpress->duration_minutes)->format('H:i:s'),
                'status' => 'confirmed',
                'service_name' => $manicuraExpress->name,
                'service_duration_minutes' => $manicuraExpress->duration_minutes,
                'service_price' => $manicuraExpress->price,
                'notes' => null,
            ]
        );

        Appointment::updateOrCreate(
            [
                'business_id' => $glowBeauty->id,
                'employee_id' => $paula->id,
                'appointment_date' => $nextWednesday->toDateString(),
                'start_time' => '10:30:00',
            ],
            [
                'user_id' => $lucia->id,
                'service_id' => $limpiezaFacial->id,
                'end_time' => Carbon::parse('10:30:00')->addMinutes($limpiezaFacial->duration_minutes)->format('H:i:s'),
                'status' => 'confirmed',
                'service_name' => $limpiezaFacial->name,
                'service_duration_minutes' => $limpiezaFacial->duration_minutes,
                'service_price' => $limpiezaFacial->price,
                'notes' => 'Piel sensible',
            ]
        );

        Appointment::updateOrCreate(
            [
                'business_id' => $glowBeauty->id,
                'employee_id' => $claudia->id,
                'appointment_date' => $nextThursday->toDateString(),
                'start_time' => '17:00:00',
            ],
            [
                'user_id' => $elena->id,
                'service_id' => $cejas->id,
                'end_time' => Carbon::parse('17:00:00')->addMinutes($cejas->duration_minutes)->format('H:i:s'),
                'status' => 'pending',
                'service_name' => $cejas->name,
                'service_duration_minutes' => $cejas->duration_minutes,
                'service_price' => $cejas->price,
                'notes' => null,
            ]
        );

        Appointment::updateOrCreate(
            [
                'business_id' => $glowBeauty->id,
                'employee_id' => $paula->id,
                'appointment_date' => $nextFriday->toDateString(),
                'start_time' => '16:00:00',
            ],
            [
                'user_id' => $sergio->id,
                'service_id' => $depilacion->id,
                'end_time' => Carbon::parse('16:00:00')->addMinutes($depilacion->duration_minutes)->format('H:i:s'),
                'status' => 'confirmed',
                'service_name' => $depilacion->name,
                'service_duration_minutes' => $depilacion->duration_minutes,
                'service_price' => $depilacion->price,
                'notes' => null,
            ]
        );
    }
}
