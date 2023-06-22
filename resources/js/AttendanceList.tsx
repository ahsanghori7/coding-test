import React, { useEffect, useState } from 'react';
import axios from 'axios';

interface Attendance {
  name: string;
  checkin: string | null;
  checkout: string | null;
  totalWorkingHours: number | null;
}

const AttendanceList: React.FC = () => {
  const [attendanceList, setAttendanceList] = useState<Attendance[]>([]);

  useEffect(() => {
    // Fetch attendance data from the API endpoint
    const fetchAttendanceData = async () => {
      try {
        const response = await axios.get('api/attendance/'); // Replace with your actual API endpoint
        setAttendanceList(response.data);
      } catch (error) {
        console.error('Error fetching attendance data:', error);
      }
    };

    fetchAttendanceData();
  }, []);

  return (
    <div>
      <h1>Attendance List</h1>
      <table>
        <thead>
          <tr>
            <th>Name</th>
            <th>Check-in</th>
            <th>Check-out</th>
            <th>Total Working Hours</th>
          </tr>
        </thead>
        <tbody>
          {attendanceList.map((attendance, index) => (
            <tr key={index}>
              <td>{attendance.name}</td>
              <td>{attendance.checkin || 'N/A'}</td>
              <td>{attendance.checkout || 'N/A'}</td>
              <td>{attendance.totalWorkingHours || 'N/A'}</td>
            </tr>
          ))}
        </tbody>
      </table>
    </div>
  );
};

export default AttendanceList;