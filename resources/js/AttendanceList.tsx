import React, { useEffect, useState } from 'react';
import axios from 'axios';

const AttendanceList = () => {
  const [attendanceList, setAttendanceList] = useState([]);

  useEffect(() => {
    // Fetch attendance data from the API endpoint
    const fetchAttendanceData = async () => {
      try {
        const response = await axios.get('api/attendance'); // Replace with your actual API endpoint
        setAttendanceList(response.data.attendance);
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
          {Array.isArray(attendanceList)  && attendanceList.length > 0 ? (
            attendanceList.map((attendance, index) => (
              <tr key={index}>
                <td>{attendance.employee.full_name}</td>
                <td>{attendance.clock_in || 'N/A'}</td>
                <td>{attendance.clock_out || 'N/A'}</td>
                <td>{attendance.totalWorkingHours.toFixed() || 'N/A'}</td>
              </tr>
            ))
          ) : (
            <tr>
              <td colSpan={4}>No attendance data available</td>
            </tr>
          )}
        </tbody>
      </table>
    </div>
  );
};

export default AttendanceList;