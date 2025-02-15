<?php

namespace App\Models;

use App\Core\Database;

class Booking
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    public function createBooking($userId, $trainId, $seats)
    {
        // Check if enough seats are available
        $sql = "SELECT seats_available, total_seats FROM trains WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$trainId]);
        $train = $stmt->fetch();

        // If no train is found or there are not enough available seats
        if (!$train) {
            return false; // Train not found
        }

        // Calculate available seats: total seats - booked seats
        $availableSeats = $train['total_seats'] - abs($train['seats_available']);

        if ($availableSeats < $seats) {
            return false; // Not enough seats available
        }

        // Start a transaction to ensure both queries succeed or fail together
        $this->db->beginTransaction();

        try {
            // Insert booking into the bookings table
            $sql = "INSERT INTO bookings (user_id, train_id, seats, status) VALUES (?, ?, ?, 'confirmed')";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([$userId, $trainId, $seats]);

            // Update the available seats in the trains table
            $updateSeatsSql = "UPDATE trains SET seats_available = seats_available - ? WHERE id = ?";
            $stmt = $this->db->prepare($updateSeatsSql);
            $stmt->execute([$seats, $trainId]);

            // Commit the transaction
            $this->db->commit();

            return true;
        } catch (\PDOException $e) {
            // Rollback the transaction in case of an error
            $this->db->rollBack();
            throw $e;
        }
    }

    public function getUserBookings($userId)
    {
        $sql = "SELECT b.id, t.train_name, t.source, t.destination, b.seats, b.status 
                FROM bookings b 
                JOIN trains t ON b.train_id = t.id 
                WHERE b.user_id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$userId]);
        return $stmt->fetchAll();
    }
}
